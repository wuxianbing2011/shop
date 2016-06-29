<?php
class Pager {
	//上一页 2 3 4 5 6 7 8 9 10 11 下一页
	public static function style1($currpage, $perpage, $nums, $q, $currPageStyle='', $othersPageStyle='',$dp = 10) {
		$nums = intval($nums);
		$maxPages = ceil($nums/$perpage);
		$pageStart=1;
		if ($maxPages==0) {
			$maxPages = 1;
		}
		if ($currpage>$maxPages) {
			$currpage=$maxPages;
		}
		if ($currpage<=1) {
			$s = "<span class=\"{$currPageStyle}\">上页 </span>";
			$pageStart = 1;
			$currpage=1;
			$pageEnd=$dp;
		} else {
			$tmp = $currpage-1;
			$s = "<a href=\"".str_replace('{page}', $tmp, $q)."\" class=\"{$othersPageStyle}\">上页</a> ";
			/*** 下面开始计算 1--$dp 以后的 $pageStart ***/
			$rangeOrder = floor(($currpage-2)/($dp-2));
			$pageStart = $rangeOrder*($dp-2)+1;
			$pageEnd=$pageStart+$dp-1;
		}

		for ($i=$pageStart; $i<=$pageEnd; $i++) {
			if ($i>$maxPages) {
				break;
			}
			if ($i!=$currpage) {
				$s.= '<a href="'.str_replace('{page}', $i, $q).'" class="'.$othersPageStyle.'">'.$i.'</a> ';
			}
			else {
				$s.= '<span class="'.$currPageStyle.'">'.$i.'</span> ';
			}
		}

		if ($currpage>=$maxPages) {
			$s.= "<span class=\"{$currPageStyle}\">下页 </span>";
		} else {
			$tmp = $currpage+1;
			$s.= "<a href=\"".str_replace('{page}', $tmp, $q)."\" class=\"{$othersPageStyle}\">下页</a>";
		}
		return $s;
	}

	//首页 上一页 2 3 4 5 6 7 8 9 10 11 下一页 末页
	public static function style2($currpage, $perpage, $nums, $q, $currPageStyle='', $disabledPageStyle='', $othersPageStyle='', $dp = 10) {
		$nums = intval($nums);
		$maxPages = ceil($nums/$perpage);
		$pageStart=1;
		if ($maxPages==0) {
			$maxPages = 1;
		}
		if ($currpage>$maxPages) {
			$currpage=$maxPages;
		}
		if ($currpage<=1) {
			$s = "<a class=\"first\" href=\"javascript:void 0;\" class=\"{$disabledPageStyle}\">首页 </a> <a class=\"prev\" href=\"javascript:void 0;\" class=\"{$disabledPageStyle}\">上页 </a>";
			$pageStart = 1;
			$currpage=1;
			$pageEnd=$dp;
		} else {
			$tmp = $currpage-1;
			$s =  "<a class=\"first\" href=\"".str_replace('{page}', "1", $q)."\" class=\"{$othersPageStyle}\">首页</a> "."<a class=\"prev\" href=\"".str_replace('{page}', $tmp, $q)."\" class=\"{$othersPageStyle}\">上页</a> ";
			/*** 下面开始计算 1--$dp 以后的 $pageStart ***/
			$rangeOrder = floor(($currpage-2)/($dp-2));
			$pageStart = $rangeOrder*($dp-2)+1;
			$pageEnd=$pageStart+$dp-1;
		}

		for ($i=$pageStart; $i<=$pageEnd; $i++) {
			if ($i>$maxPages) {
				break;
			}
			if ($i!=$currpage) {
				$s.= '<a page="'.$i.'" href="'.str_replace('{page}', $i, $q).'" class="page '.$othersPageStyle.'">'.$i.'</a> ';
			}
			else {
				$s.= '<a  page="'.$i.'" href="javascript:void 0;" class="page '.$currPageStyle.'">'.$i.'</a> ';
			}
		}

		if ($currpage>=$maxPages) {
			$s.= "<a class=\"next\" href=\"javascript:void 0;\" class=\"{$disabledPageStyle}\">下页 </a> <a class=\"last\" href=\"javascript:void 0;\" class=\"{$disabledPageStyle}\"> 末页</a>";
		} else {
			$tmp = $currpage+1;
			$s.= "<a class=\"next\" href=\"".str_replace('{page}', $tmp, $q)."\" class=\"{$othersPageStyle}\">下页</a>"." <a class=\"last\" href=\"".str_replace('{page}', $maxPages, $q)."\" class=\"{$othersPageStyle}\">末页</a>";
		}
		return $s;
	}
}