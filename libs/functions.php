<?php
function getParam($key, $default='') {
	if (isset($_REQUEST[$key])) {
		//filter xss attacks!
		return check_plain(filter_xss($_REQUEST[$key], array()));
	}
	return $default;
}

function lcLog($msg) {
	file_put_contents(__DIR__."/../logs/".date("Ym/d").".txt", date("H:i:s ").$msg."\n", FILE_APPEND);
}

function redirect($msg=null, $url, $seconds=3) {
	if ($msg === null) {
		$html = '<html><head></head><body><script type="text/javascript">window.location.href="{url}";</script></body></html>';
		$html = str_replace("{url}", $url, $html);
		exit($html);
	} elseif(!empty(Config::$config['common']['redirect_page']) && file_exists(Config::$config['common']['redirect_page'])) {
		include Config::$config['common']['redirect_page'];
		exit;
	} else {
		$seconds = intval($seconds) > 0 ? intval($seconds) : 3;
		$html = '<html><head></head><body><script type="text/javascript">setTimeout(function(){window.location.href="{url}";}, {seconds});</script>{msg}</body></html>';
		$html = str_replace("{url}", $url, $html);
		$html = str_replace("{msg}", $msg, $html);
		$html = str_replace("{seconds}", $seconds, $html);
		exit($html);
	}
}

function showError($errorMessage, $url=false) {
	if(!empty(Config::$config['common']['error_page']) && file_exists(Config::$config['common']['error_page'])) {
		include Config::$config['common']['error_page'];
		exit;
	} else {
		$html = '<html><head></head><body><p>{msg}</p><p><a href="javascript:window.history.back();">返回上一页</a></p></body></html>';
		$html = str_replace("{msg}", $errorMessage, $html);
		exit($html);
	}
}


/**
 * Filters HTML to prevent cross-site-scripting (XSS) vulnerabilities.
 *
 * Based on kses by Ulf Harnhammar, see http://sourceforge.net/projects/kses.
 * For examples of various XSS attacks, see: http://ha.ckers.org/xss.html.
 *
 * This code does four things:
 * - Removes characters and constructs that can trick browsers.
 * - Makes sure all HTML entities are well-formed.
 * - Makes sure all HTML tags and attributes are well-formed.
 * - Makes sure no HTML tags contain URLs with a disallowed protocol (e.g.
 *   javascript:).
 *
 * @param $string
 *   The string with raw HTML in it. It will be stripped of everything that can
 *   cause an XSS attack.
 * @param $allowed_tags
 *   An array of allowed tags.
 *
 * @return
 *   An XSS safe version of $string, or an empty string if $string is not
 *   valid UTF-8.
 *
 * @see drupal_validate_utf8()
 */
function filter_xss($string, $allowed_tags = array('a', 'em', 'strong', 'cite', 'blockquote', 'code', 'ul', 'ol', 'li', 'dl', 'dt', 'dd')) {
	// Only operate on valid UTF-8 strings. This is necessary to prevent cross
	// site scripting issues on Internet Explorer 6.
	if (!drupal_validate_utf8($string)) {
		return '';
	}
	// Store the text format.
	_filter_xss_split($allowed_tags, TRUE);
	// Remove NULL characters (ignored by some browsers).
	$string = str_replace(chr(0), '', $string);
	// Remove Netscape 4 JS entities.
	$string = preg_replace('%&\s*\{[^}]*(\}\s*;?|$)%', '', $string);

	// Defuse all HTML entities.
	$string = str_replace('&', '&amp;', $string);
	// Change back only well-formed entities in our whitelist:
	// Decimal numeric entities.
	$string = preg_replace('/&amp;#([0-9]+;)/', '&#\1', $string);
	// Hexadecimal numeric entities.
	$string = preg_replace('/&amp;#[Xx]0*((?:[0-9A-Fa-f]{2})+;)/', '&#x\1', $string);
	// Named entities.
	$string = preg_replace('/&amp;([A-Za-z][A-Za-z0-9]*;)/', '&\1', $string);

	return preg_replace_callback('%
    (
    <(?=[^a-zA-Z!/])  # a lone <
    |                 # or
    <!--.*?-->        # a comment
    |                 # or
    <[^>]*(>|$)       # a string that starts with a <, up until the > or the end of the string
    |                 # or
    >                 # just a >
    )%x', '_filter_xss_split', $string);
}

/**
 * Processes an HTML tag.
 *
 * @param $m
 *   An array with various meaning depending on the value of $store.
 *   If $store is TRUE then the array contains the allowed tags.
 *   If $store is FALSE then the array has one element, the HTML tag to process.
 * @param $store
 *   Whether to store $m.
 *
 * @return
 *   If the element isn't allowed, an empty string. Otherwise, the cleaned up
 *   version of the HTML element.
 */
function _filter_xss_split($m, $store = FALSE) {
	static $allowed_html;

	if ($store) {
		$allowed_html = array_flip($m);
		return;
	}

	$string = $m[1];

	if (substr($string, 0, 1) != '<') {
		// We matched a lone ">" character.
		return '&gt;';
	}
	elseif (strlen($string) == 1) {
		// We matched a lone "<" character.
		return '&lt;';
	}

	if (!preg_match('%^<\s*(/\s*)?([a-zA-Z0-9\-]+)([^>]*)>?|(<!--.*?-->)$%', $string, $matches)) {
		// Seriously malformed.
		return '';
	}

	$slash = trim($matches[1]);
	$elem = &$matches[2];
	$attrlist = &$matches[3];
	$comment = &$matches[4];

	if ($comment) {
		$elem = '!--';
	}

	if (!isset($allowed_html[strtolower($elem)])) {
		// Disallowed HTML element.
		return '';
	}

	if ($comment) {
		return $comment;
	}

	if ($slash != '') {
		return "</$elem>";
	}

	// Is there a closing XHTML slash at the end of the attributes?
	$attrlist = preg_replace('%(\s?)/\s*$%', '\1', $attrlist, -1, $count);
	$xhtml_slash = $count ? ' /' : '';

	// Clean up attributes.
	$attr2 = implode(' ', _filter_xss_attributes($attrlist));
	$attr2 = preg_replace('/[<>]/', '', $attr2);
	$attr2 = strlen($attr2) ? ' ' . $attr2 : '';

	return "<$elem$attr2$xhtml_slash>";
}

/**
 * Processes a string of HTML attributes.
 *
 * @return
 *   Cleaned up version of the HTML attributes.
 */
function _filter_xss_attributes($attr) {
	$attrarr = array();
	$mode = 0;
	$attrname = '';

	while (strlen($attr) != 0) {
		// Was the last operation successful?
		$working = 0;

		switch ($mode) {
			case 0:
				// Attribute name, href for instance.
				if (preg_match('/^([-a-zA-Z]+)/', $attr, $match)) {
					$attrname = strtolower($match[1]);
					$skip = ($attrname == 'style' || substr($attrname, 0, 2) == 'on');
					$working = $mode = 1;
					$attr = preg_replace('/^[-a-zA-Z]+/', '', $attr);
				}
				break;

			case 1:
				// Equals sign or valueless ("selected").
				if (preg_match('/^\s*=\s*/', $attr)) {
					$working = 1; $mode = 2;
					$attr = preg_replace('/^\s*=\s*/', '', $attr);
					break;
				}

				if (preg_match('/^\s+/', $attr)) {
					$working = 1; $mode = 0;
					if (!$skip) {
						$attrarr[] = $attrname;
					}
					$attr = preg_replace('/^\s+/', '', $attr);
				}
				break;

			case 2:
				// Attribute value, a URL after href= for instance.
				if (preg_match('/^"([^"]*)"(\s+|$)/', $attr, $match)) {
					$thisval = filter_xss_bad_protocol($match[1]);

					if (!$skip) {
						$attrarr[] = "$attrname=\"$thisval\"";
					}
					$working = 1;
					$mode = 0;
					$attr = preg_replace('/^"[^"]*"(\s+|$)/', '', $attr);
					break;
				}

				if (preg_match("/^'([^']*)'(\s+|$)/", $attr, $match)) {
					$thisval = filter_xss_bad_protocol($match[1]);

					if (!$skip) {
						$attrarr[] = "$attrname='$thisval'";
					}
					$working = 1; $mode = 0;
					$attr = preg_replace("/^'[^']*'(\s+|$)/", '', $attr);
					break;
				}

				if (preg_match("%^([^\s\"']+)(\s+|$)%", $attr, $match)) {
					$thisval = filter_xss_bad_protocol($match[1]);

					if (!$skip) {
						$attrarr[] = "$attrname=\"$thisval\"";
					}
					$working = 1; $mode = 0;
					$attr = preg_replace("%^[^\s\"']+(\s+|$)%", '', $attr);
				}
				break;
		}

		if ($working == 0) {
			// Not well formed; remove and try again.
			$attr = preg_replace('/
        ^
        (
        "[^"]*("|$)     # - a string that starts with a double quote, up until the next double quote or the end of the string
        |               # or
        \'[^\']*(\'|$)| # - a string that starts with a quote, up until the next quote or the end of the string
        |               # or
        \S              # - a non-whitespace character
        )*              # any number of the above three
        \s*             # any number of whitespaces
        /x', '', $attr);
			$mode = 0;
		}
	}

	// The attribute list ends with a valueless attribute like "selected".
	if ($mode == 1 && !$skip) {
		$attrarr[] = $attrname;
	}
	return $attrarr;
}

/**
 * Processes an HTML attribute value and strips dangerous protocols from URLs.
 *
 * @param $string
 *   The string with the attribute value.
 * @param $decode
 *   (deprecated) Whether to decode entities in the $string. Set to FALSE if the
 *   $string is in plain text, TRUE otherwise. Defaults to TRUE. This parameter
 *   is deprecated and will be removed in Drupal 8. To process a plain-text URI,
 *   call drupal_strip_dangerous_protocols() or check_url() instead.
 *
 * @return
 *   Cleaned up and HTML-escaped version of $string.
 */
function filter_xss_bad_protocol($string, $decode = TRUE) {
	// Get the plain text representation of the attribute value (i.e. its meaning).
	// @todo Remove the $decode parameter in Drupal 8, and always assume an HTML
	//   string that needs decoding.
	if ($decode) {
		if (!function_exists('decode_entities')) {
			require_once DRUPAL_ROOT . '/includes/unicode.inc';
		}

		$string = decode_entities($string);
	}
	return check_plain(drupal_strip_dangerous_protocols($string));
}

/**
 * Checks whether a string is valid UTF-8.
 *
 * All functions designed to filter input should use drupal_validate_utf8
 * to ensure they operate on valid UTF-8 strings to prevent bypass of the
 * filter.
 *
 * When text containing an invalid UTF-8 lead byte (0xC0 - 0xFF) is presented
 * as UTF-8 to Internet Explorer 6, the program may misinterpret subsequent
 * bytes. When these subsequent bytes are HTML control characters such as
 * quotes or angle brackets, parts of the text that were deemed safe by filters
 * end up in locations that are potentially unsafe; An onerror attribute that
 * is outside of a tag, and thus deemed safe by a filter, can be interpreted
 * by the browser as if it were inside the tag.
 *
 * The function does not return FALSE for strings containing character codes
 * above U+10FFFF, even though these are prohibited by RFC 3629.
 *
 * @param $text
 *   The text to check.
 *
 * @return
 *   TRUE if the text is valid UTF-8, FALSE if not.
 */
function drupal_validate_utf8($text) {
	if (strlen($text) == 0) {
		return TRUE;
	}
	// With the PCRE_UTF8 modifier 'u', preg_match() fails silently on strings
	// containing invalid UTF-8 byte sequences. It does not reject character
	// codes above U+10FFFF (represented by 4 or more octets), though.
	return (preg_match('/^./us', $text) == 1);
}

/**
 * Encodes special characters in a plain-text string for display as HTML.
 *
 * Also validates strings as UTF-8 to prevent cross site scripting attacks on
 * Internet Explorer 6.
 *
 * @param string $text
 *   The text to be checked or processed.
 *
 * @return string
 *   An HTML safe version of $text. If $text is not valid UTF-8, an empty string
 *   is returned and, on PHP < 5.4, a warning may be issued depending on server
 *   configuration (see @link https://bugs.php.net/bug.php?id=47494 @endlink).
 *
 * @see drupal_validate_utf8()
 * @ingroup sanitization
 */
function check_plain($text) {
	return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

/**
 * Decodes all HTML entities (including numerical ones) to regular UTF-8 bytes.
 *
 * Double-escaped entities will only be decoded once ("&amp;lt;" becomes "&lt;"
 * , not "<"). Be careful when using this function, as decode_entities can
 * revert previous sanitization efforts (&lt;script&gt; will become <script>).
 *
 * @param $text
 *   The text to decode entities in.
 *
 * @return
 *   The input $text, with all HTML entities decoded once.
 */
function decode_entities($text) {
	return html_entity_decode($text, ENT_QUOTES, 'UTF-8');
}

/**
 * Strips dangerous protocols (e.g. 'javascript:') from a URI.
 *
 * This function must be called for all URIs within user-entered input prior
 * to being output to an HTML attribute value. It is often called as part of
 * check_url() or filter_xss(), but those functions return an HTML-encoded
 * string, so this function can be called independently when the output needs to
 * be a plain-text string for passing to t(), l(), drupal_attributes(), or
 * another function that will call check_plain() separately.
 *
 * @param $uri
 *   A plain-text URI that might contain dangerous protocols.
 *
 * @return
 *   A plain-text URI stripped of dangerous protocols. As with all plain-text
 *   strings, this return value must not be output to an HTML page without
 *   check_plain() being called on it. However, it can be passed to functions
 *   expecting plain-text strings.
 *
 * @see check_url()
 */
function drupal_strip_dangerous_protocols($uri) {
	static $allowed_protocols;

	if (!isset($allowed_protocols)) {
		$allowed_protocols = array_flip(variable_get('filter_allowed_protocols', array('ftp', 'http', 'https', 'irc', 'mailto', 'news', 'nntp', 'rtsp', 'sftp', 'ssh', 'tel', 'telnet', 'webcal')));
	}

	// Iteratively remove any invalid protocol found.
	do {
		$before = $uri;
		$colonpos = strpos($uri, ':');
		if ($colonpos > 0) {
			// We found a colon, possibly a protocol. Verify.
			$protocol = substr($uri, 0, $colonpos);
			// If a colon is preceded by a slash, question mark or hash, it cannot
			// possibly be part of the URL scheme. This must be a relative URL, which
			// inherits the (safe) protocol of the base document.
			if (preg_match('![/?#]!', $protocol)) {
				break;
			}
			// Check if this is a disallowed protocol. Per RFC2616, section 3.2.3
			// (URI Comparison) scheme comparison must be case-insensitive.
			if (!isset($allowed_protocols[strtolower($protocol)])) {
				$uri = substr($uri, $colonpos + 1);
			}
		}
	} while ($before != $uri);

	return $uri;
}