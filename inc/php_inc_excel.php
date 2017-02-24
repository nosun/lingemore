<?php       
    class CExcel    
    {    
        //Header of excel document (prepended to the rows)     
        var $m_strHeader = "<?xml version=\"1.0\" encoding=\"UTF-8\"?\>    
                            <Workbook xmlns=\"urn:schemas-microsoft-com:office:spreadsheet\"   
                            xmlns:x=\"urn:schemas-microsoft-com:office:excel\"   
                            xmlns:ss=\"urn:schemas-microsoft-com:office:spreadsheet\"   
                            xmlns:html=\"http://www.w3.org/TR/REC-html40\">";    
            
        //Footer of excel document (appended to the rows)     
        var $m_strFooter = "</Workbook>";     
            
        //Document lines (rows in an array)    
        var $m_arrLines = array();    
            
        //Worksheet title    
        var $m_strTitle = "table1";         
            
        function __construct($strTitle = "table1")    
        {    
            $this->m_strTitle = $strTitle;    
        }    
            
        function __destruct()    
        {    
        }    
        
        //Add a single row to the $document string     
        function AddRow($arrInfo)    
        {    
            // initialize all cells for this row    
            $strCells = "";    
                
            //foreach key -> write value into cells    
            foreach ($arrInfo as $key => $val)    
            {    
                //加个字符串与数字的判断,避免生成的 excel 出现数字以字符串存储的警告    
                if (is_numeric($val))    
                {    
                    //防止首字母为0时生成 excel 后0丢失    
                    if (0 == substr($val, 0, 1))    
                    {    
                        $strCells .= "<Cell><Data ss:Type=\"String\">" . $val . "</Data></Cell>\n";    
                    }    
                    else   
                    {    
                        $strCells .= "<Cell><Data ss:Type=\"Number\">" . $val . "</Data></Cell>\n";    
                    }    
                }    
                else   
                {    
                    $strCells .= "<Cell><Data ss:Type=\"String\">" . $val . "</Data></Cell>\n";    
                }    
            }    
                
            //transform $cells content into one row    
            $this->arrLines[] = "<Row>\n" . $strCells . "</Row>\n";    
        }    
            
        //Add an array to the document    
        function AddMutiRow($arrInfos)    
        {    
            foreach ($arrInfos as $key => $val)    
            {    
                $this->AddRow($val);    
            }    
        }    
                    
        //Set the worksheet title    
        //Checks the string for not allowed characters (:\/?*),cuts it to maximum 31 characters and set the title.    
        //Damn why are not-allowed chars nowhere to be found? Windows help's no help…     
        function SetWorksheetTitle($strTitle)    
        {    
            $strTitle = preg_replace("/[\\\|:|\/|\?|\*|\[|\]]/", "", $strTitle);    
            $strTitle = substr($strTitle, 0, 31);    
                
            $this->m_strTitle = $strTitle;    
        }    
            
        //Generate the excel file    
        //Finally generates the excel file and uses the header() function to deliver it to the browser.     
        function SaveExcel($strFile)    
        {    
            //deliver header (as recommended in php manual)    
            header("Content-Type: application/vnd.ms-excel; charset=UTF-8");    
            header("Content-Disposition: inline; filename=\"" . $filename . ".xls\"");    
                
            //print out document to the browser need to use stripslashes for the damn ">"    
            echo stripslashes($this->m_strHeader);    
            echo "\n<Worksheet ss:Name=\"" . $this->m_strTitle . "\">\n<Table>\n";    
            echo "<Colum ss:Index=\"1\" ss:AutoFitWidth=\"0\" ss:width=\"110\" />\n";    
            echo implode("\n", $this->arrLines);    
            echo "</Table>\n</Worksheet>\n";    
            echo $this->m_strFooter;    
        }    
    } 

 ?>  