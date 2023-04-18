<?php 
require "akses.php";
if ($akses["jabatan"] <> "KEUANGAN"){header ("Location:./?message=Akses Tidak Diijinkan&alert=alert alert-danger");}

    $tglnow   = date("Y-m-d");
    $tglawal  = date("Y-m-01");
    $tglakhir = date("Y-m-d");
    $search1    = $_POST['search1'];
    $search2    = $_POST['search2'];
    include "mainhead.php";
?>

<script>
$(document).ready(function(){
$("#contactus-submit").click(function(){
var r= $('<i class="fa fa-spinner fa-spin" style="font-size:20px;"></i>');
$("#contactus-submit").html(r);
$("#contactus-submit").append("  &nbsp; Submitting...");
$("#contactus-submit").attr("disabled", true);


setTimeout(function(){
$("#contactus-submit").attr("disabled", false);
$("#contactus-submit").html('Submit');

}, 10000);
});
});
</script>

<div style="height:100px;"></div>


<script LANGUAGE="JavaScript">
    function showDetails(bookURL){
       window.open(bookURL,"bookDetails","width=950,height=750","center");
    }
</script>

<body onload="document.form1.search.focus();">

<table width="90%">
<td valign="top" style="width:65%;background:white;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:10px;">
<table width="90%" style="margin-top:40px;">
<td width="100%" align="center">
<FORM language="javascript" name="form1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<table width="100%">
    
<td width="30%">
    <table width="100%">
    <td colspan="3"><a href="keuangan" tooltip='Kembali ke dashboard' flow='left'><i class="fa fa-arrow-left" style="color:grey;font-size:22px;"></i></a> &nbsp; &nbsp; <font size="4" color="#5b8ff5"><b>Jurnal Umum</b></font></td></tr>
    <td colspan="3" height="30">&nbsp;</td></tr>
    <td width="20%"><font size="3"><b>Periode Transaksi :</b></font><br>
    <input id="search" name="search1" type="date" placeholder="start date" autocomplete="off" style="width:95%;"></td>
    <td width="20%"><br>
    <input id="search" name="search2" type="date" placeholder="end date" autocomplete="off" style="width:95%;margin-top:12px;"></td>
    <td align="left" width="20%"><button style="margin-top:20px;">Submit</button></form></td>
    </table>
</td></tr>

<td colspan="2" height="20"><hr style="border:0px;height:3px;background:#579BE1;"></td>
</table>
</td></tr>
</table>

<?php

    include "paging.php";
    if ($search1 <> "" and $search2 <> "") {$search = "where tanggal between '$search1' and '$search2' order by no asc";}
    if ($search1 == "" and $search2 == "") {$search = "where tanggal like '$tglnow' order by no asc";}

    $pagenumber = new PageNumber();
    //Show Record
    $pagenumber->limit   = 100;
    $pagenumber->page    = isset($_GET['page']) ? $_GET['page'] : 1;
    $query   = "select count(*) from mutasi $search";
    //Show PageNumber
    $pagenumber->TotalPageNumber     = 3;
    $pagenumber->GenerateAll($koneksi, $query);
 
    if($pagenumber->TotalRecord){

        $query=mysqli_query($koneksi, "SELECT * FROM mutasi $search limit {$pagenumber->start}, {$pagenumber->limit}");

        echo '
        <table width="90%">
        <tr bgcolor="#579BE1" height="35">
        <td width="4%" align="center" style="padding:5px;"><font color="white" face="verdana" size="2">No</font></td>
        <td width="10%" align="center" style="padding:5px;"><font color="white" face="verdana" size="2">Tanggal</font></td>
        <td width="10%" align="center" style="padding:5px;"><font color="white" face="verdana" size="2">No Jurnal</font></td>
        <td width="27%" align="left" style="padding:5px;"><font color="white" face="verdana" size="2">Akun</font></td>
        <td width="8%" align="right" style="padding:5px;"><font color="white" face="verdana" size="2">Debet</font></td>
        <td width="8%" align="right" style="padding:5px;"><font color="white" face="verdana" size="2">Kredit</font></td>
        </tr>';
        $no  = 0;
        $saldoawal = 0;
        while ($record=mysqli_fetch_array($query)){
            $no++;

            $sql  = mysqli_query($koneksi, "SELECT * FROM list_akun WHERE name like '$record[nama_akun]'") or die (mysqli_error());
            $akun = mysqli_fetch_assoc($sql);

            $saldoawal = $saldoawal + $record["debet"] - $record["kredit"];
            $saldoawalrp = number_format($saldoawal,2,",",".");
            $debetrp = number_format($record["debet"],2,",",".");
            $kreditrp   = number_format($record["kredit"],2,",",".");

            if ($debetrp == "0"){$debetrp2 = "";}
            if ($debetrp <> "0"){$debetrp2 = "$debetrp";}
            if ($kreditrp == "0"){$kreditrp2 = "";}
            if ($kreditrp <> "0"){$kreditrp2 = "$kreditrp";}

            if ($record["description"] == ""){$desk = "";}
            if ($record["description"] <> ""){$desk = "$record[description]";}

            if($no%2==1){$bg = "#ffffff";} else { $bg = "#d1d1d1";}

            echo "
            <tr bgcolor='$bg'>
            <td align='center' style='border:1px solid #CECECE;padding:5px;'>".$no."</td>
            <td align='center' style='border:1px solid #CECECE;padding:5px;'>".$record['tanggal']."</td>
            <td align='center' style='border:1px solid #CECECE;padding:5px;'>".$record['jurnalno']."</td>
            <td align='left' style='border:1px solid #CECECE;padding:5px;'>$record[nama_akun]</td>
            <td align='right' style='border:1px solid #CECECE;padding:5px;'>".$debetrp2."</td>
            <td align='right' style='border:1px solid #CECECE;padding:5px;'>".$kreditrp2."</td>
            </tr>
        ";
    }
}
?>
</tr></table>

<table width="100%" style="margin-top:0px;">
<td height="70">&nbsp;</td></tr>
</table>

</td>
</table>

<table width="100%" style="margin-top:0px;">
<td height="50">&nbsp;</td></tr>
</table>
