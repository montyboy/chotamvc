<?php

class Grid{
	
	
	
	# Constructor to initialise class
	public function __construct($listID){
		$this->listID = $listID;
		$this->listWidth = "";
		$this->ItemArr = Array();
		
		$this->model = "";
		
		$this->tableName = "";
		$this->whereCond = "";
		$this->orderBy = "";
		$this->orderTyp = "";
		$this->changeOrderMode = false;
		$this->SQL = "";
		$this->currentPageURL = "";
		
		$this->extraURLPara = "";
		
		
		#Paging
		$this->start = (!empty($_GET['start'])) ? $_GET['start'] : 0;
		$this->totResult = "";
		$this->showPerPage = "";
		$this->currentPageRes = "";
		
		$this->img_path = BASEPATH."cms/images/";
		
		
		# Images
		$this->editImg = "<img src=\"".$this->img_path."edit.gif\" width=\"16\" height=\"16\" alt=\"Edit\" title=\"Edit\" border=\"0\"/>";
		$this->deleteImg = "<img src=\"".$this->img_path."delete.gif\" width=\"16\" height=\"16\" alt=\"Delete\" title=\"Delete\" border=\"0\" />";
		$this->orderAsc = "<img src=\"".$this->img_path."asc.gif\" width=\"6\" height=\"6\" alt=\"Ascending\" title=\"Ascending\" border=\"0\" />";
		$this->orderDesc = "<img src=\"".$this->img_path."desc.gif\" width=\"6\" height=\"6\" alt=\"Descending\" title=\"Descending\"  border=\"0\" />";
		$this->activeImg = "<img src=\"".$this->img_path."active.gif\" width=\"22\" height=\"23\" alt=\"Active\" title=\"Active\" border=\"0\" />";
		$this->inactiveImg = "<img src=\"".$this->img_path."inactive.gif\" width=\"22\" height=\"22\" alt=\"Inactive\" title=\"Inactive\" border=\"0\" />";
		$this->nextImg = "<img src=\"".$this->img_path."next.gif\" width=\"16\" height=\"16\" alt=\"Next\" title=\"Next\" border=\"0\" />";
		$this->prevImg = "<img src=\"".$this->img_path."prev.gif\" width=\"16\" height=\"16\" alt=\"Previous\" title=\"Previous\" border=\"0\" />";
		
		# Messages
		$this->listErrorMsg = "No records found.";
		$this->deleteMsg = "Delete this record?";
	}
	
	private function pregString($string){
		preg_match_all("|\[(.*)\]|i" ,$string, $matches3);
		return ($matches3[1][0]!='NULL') ? $matches3[1][0] : "";
	}
	
	# Fuction to create list
	public function createList(){
		
		$listData = "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" id=\"".$this->listID."\" class=\"table table-striped\" width=\"".$this->listWidth."\">";
		# Create the row columns
		$listData.= "<tr>";	
		foreach($this->ItemArr as $key => $values){
			unset($matches,$matches2);
			preg_match_all("/{(.*)}/i", $values, $matches);
			preg_match_all("|\[[^\]]+\]|i" ,$matches[1][0], $matches2);
			
			$width = (isset($matches2[0][3]) && !empty($matches2[0][3])) ? "width=\"".$this->pregString($matches2[0][3])."\"" : "";
			$urlKEY[$key] = (isset($matches2[0][4]) && !empty($matches2[0][4])) ? $this->pregString($matches2[0][4]) : "";
			$cssClass = (isset($matches2[0][5]) && !empty($matches2[0][5])) ? "colHeader ".$this->pregString($matches2[0][5]) : "colHeader";
			$style = (isset($matches2[0][6]) && !empty($matches2[0][6])) ? "style=\"".$this->pregString($matches2[0][6])."\"" : "";
			
			
			
			$useOrder = $this->pregString($matches2[0][2]);
			
			$splitField = explode(":",$this->pregString($matches2[0][1]));
			$useField[] = (!empty($splitField[1])) ? " ' ' as ".$splitField[1]: $splitField[0];
			$dbField = (!empty($splitField[1])) ? $splitField[1]: $splitField[0];
			$dbFields[] = $dbField;
			
			
			switch($dbField){
				default:
					$listData.= "<th ".$width." class=\"".$cssClass."\" ".$style." valign=\"middle\">";
					$listData.= $this->pregString($matches2[0][0]);
				break;
			}
			
			if($useOrder!='N'){
				$orderField = $orderFlag = "";
				list($orderFlag,$orderField) = explode(":",$useOrder);
				$dbField = (!empty($orderField)) ? $orderField : $dbField;
				if($dbField==$this->orderBy){
					$listData.= "<span style=\"padding-left:10px;\"><a href=\"".$this->currentPageURL."?orderBy=$dbField&orderTyp=".(($this->orderTyp=='asc')? "desc" :"asc")."".$this->extraURLPara."\">".(($this->orderTyp=='asc')? $this->orderAsc : $this->orderDesc)."</span>";
				}else{
					$listData.= "<span style=\"padding-left:10px;\"><a href=\"".$this->currentPageURL."?orderBy=$dbField&orderTyp=desc".$this->extraURLPara."\">".$this->orderAsc."</span>";
				}
			}
			
			$listData.= "</th>";
		}
		
		$this->SQL = (!empty($this->SQL)) ? $this->SQL : $this->createListSQL($useField);
		
		# Create the row data
		if($result = $this->model->find_by_sql($this->SQL)){
			if(($this->currentPageRes = count($result)) > 0){
				
				$sql = "select FOUND_ROWS() as totRows ";
				$cntData = $this->model->find_by_sql($sql);
				
				
				$this->totResult = $cntData[0]->totrows;
				$listData.= "<tr>\n";
				foreach($result as $item){
					$recID = $item->id;
					foreach($dbFields as $i=> $dbkey){
						switch($dbkey){
							case "status":
								$listData.= "<td class=\"colData\" align=\"center\" style=\"text-align:center;\" valign=\"middle\">".(($item->$dbkey=='0') ? $this->inactiveImg : $this->activeImg)."</td>\n";
							break;
							case "deleteField":
								$url =  $urlKEY[$i];
								$listData.= "<td class=\"colData\" valign=\"middle\" style=\"text-align:center;\" align=\"center\"><a href=\"".$url."/".$recID."".$this->extraURLPara."\" onclick=\"return confirm('".$this->deleteMsg."')\">".$this->deleteImg."</a></td>\n";
							break;
							case "editField":
								$url =  $urlKEY[$i];
								$listData.= "<td class=\"colData\" valign=\"middle\" style=\"text-align:center;\" align=\"center\"><a href=\"".$url."/".$recID."".$this->extraURLPara."\">".$this->editImg."</a></td>\n";
							break;
							default:
								$listData.= "<td class=\"colData\" valign=\"top\">".strip_tags(stripslashes($item->$dbkey));
								$listData.= "</td>\n";
							break;
						}
					}
					$listData.= "</tr>\n";	
				}
				
			}else{
				$this->listError();
				return false;
			}
		}
		
		$listData.= "</table>";
		
		if($this->pageNavigator){
			$this->showPageNavigator();
		}
		echo  $listData;
	}
	
	
	
	private function showPageNavigator(){
		if($this->totResult > 0){
			$totPages = ceil($this->totResult/$this->showPerPage);
			echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"List\" width=\"".$this->listWidth."\">";
			echo "<tr><td align=\"center\">";
				echo "<table border=\"0\" cellspacing=\"4\" cellpadding=\"0\" width=\"300\">";
					echo "<tr>";
						echo "<td  align=\"center\">";
						echo "<table border=\"0\" cellspacing=\"4\" cellpadding=\"0\">";
						echo "<tr>";
							echo "<td align=\"right\" width=\"30\">";
							if($this->start > 0 && $this->start-1 < $totPages){
								echo "<a href=\"".SCRIPT_NAME."?orderBy=".$this->orderBy."&orderTyp=".$this->orderTyp."&start=".($this->start-1)."".$this->extraURLPara."\">".$this->prevImg."</a>";
							}
							echo "</td>";
							echo "<td  align=\"center\">";
							echo "<select name=\"pageNo\" onchange=\"location.href='".$this->currentPageURL."?orderBy=".$this->orderBy."&orderTyp=".$this->orderTyp."&start='+ this.value+'".$this->extraURLPara."';\" style=\"width:50px;\">";
							for($i=1;$i<=$totPages;$i++){
								$selected = ($this->start==($i-1)) ? "selected" : "";
								echo "<option value=\"".($i-1)."\" ".$selected.">".$i."</option>\n";	
							}
							echo "</select>";
							echo "</td>";
							echo "<td align=\"left\" width=\"30\">";
							if($this->start+1 < $totPages){
								echo "<a href=\"".SCRIPT_NAME."?orderBy=".$this->orderBy."&orderTyp=".$this->orderTyp."&start=".($this->start+1)."".$this->extraURLPara."\">".$this->nextImg."</a>";
							}
							echo "</td>";
						echo "</tr>";	
						echo "</table>";
					echo "</td></tr>";
					echo "<tr>";
						echo "<td colspan=\"3\" align=\"center\">";
							echo "<b>Page: </b>".($this->start+1)." | <b>Records:</b> ";
							echo (($this->start==0) ? 1 : ($this->start * $this->showPerPage)+1);
							echo " to ".(($this->currentPageRes < $this->showPerPage) ? $this->totResult : ($this->currentPageRes * ($this->start+1)))." of ".$this->totResult;
						echo "</td>";
					echo "</tr>";	
				echo "</table>";		
			echo "</td></tr>";
			echo "<tr><td align=\"center\">&nbsp;</td></tr>";
			echo "</table>";
		}
	}
	
	private function createListSQL($useField){
		if(is_array($useField)){
			$sql = "select SQL_CALC_FOUND_ROWS id, ".implode(", ",$useField)." from ".$this->tableName." ";
			$sql.= "where ".((!empty($this->whereCond)) ? $this->whereCond : "1")." ";
			$sql.= "order by ".$this->orderBy." ".((!empty($this->orderTyp)) ? $this->orderTyp : "")." ";
			if(!empty($this->showPerPage)){
				$sql.= "limit ".($this->start * $this->showPerPage).", ".$this->showPerPage." ";
			}
			return $sql;
		}
	}
	
	private function listError(){
		echo "<div class=\"error\" >".$this->listErrorMsg."</div>";
	}
	
}

