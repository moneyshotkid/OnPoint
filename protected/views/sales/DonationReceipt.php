<html xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<link rel=dataStoreItem href="DonationReceipt_files/item0007.xml"
target="DonationReceipt_files/props008.xml">
<link rel=dataStoreItem href="DonationReceipt_files/item0009.xml"
target="DonationReceipt_files/props010.xml">
<style>
<!--
h1 {
	text-align:center;
	font-size:14.0pt;
	font-family:"Georgia", "serif";
	color:white;
}
h2 {
	text-align:center;
	font-size:9.0pt;
	font-family:"Georgia", "serif";
}
h3 {
	font-size:9.0pt;
	font-family:"Georgia", "serif";
}
h4 {
	text-align:center;
	font-size:10.0pt;
	font-family:"Georgia", "serif";
	font-style:italic;
}
p.MsoAcetate, li.MsoAcetate, div.MsoAcetate {
	font-size:8.0pt;
	font-family:"Tahoma", "sans-serif";
}
span.BalloonTextChar {
	font-family:"Tahoma", "sans-serif";
}
span.Heading1Char {
	font-family:"Georgia", "serif";
	color:white;
	font-weight:bold;
}
span.Heading2Char {
	font-family:"Georgia", "serif";
	font-weight:bold;
}
span.Heading3Char {
	font-family:"Georgia", "serif";
	font-weight:bold;
}
span.Heading4Char {
	font-family:"Georgia", "serif";
	font-weight:bold;
	font-style:italic;
}
p.Spacer, li.Spacer, div.Spacer {
	font-size:9.0pt;
	font-family:"Calibri", "sans-serif";
}
.MsoChpDefault {
	font-family:"Georgia", "serif";
}
.MsoPapDefault {
	line-height:115%;
}
-->
</style>
</head>

<body lang=EN-US>
<div class=WordSection1>
  <div align=center>
    <table border=1 cellspacing=0 cellpadding=0 width=840>
      <tr>
        <td width=840 colspan=4 bgcolor="#648C60"><h1>Donation Receipt from <?php echo $model->patient->name; ?> on <?php echo $model->date; ?></h1></td>
      </tr>
      
      <tr>
        <td width=53 valign=top bgcolor="white">&nbsp;</td>
        <td width=187 bgcolor="white"><h3>Donated by</h3></td>
        <td width=540 bgcolor="white"><?php echo $model->patient->name; ?></td>
        <td width=60 valign=top bgcolor="white">&nbsp;</td>
      </tr>
      <tr>
        <td width=53 valign=top bgcolor="white">&nbsp;</td>
        <td width=187 bgcolor="white"><h3>Address</h3></td>
        <td width=540 bgcolor="white"><?php echo $model->patient->address; ?></td>
        <td width=60 valign=top bgcolor="white">&nbsp;</td>
      </tr>

      <tr>
        <td width=53 valign=top bgcolor="white">&nbsp;</td>
        <td width=187 bgcolor="white"><h3>State/Province</h3></td>
        <td width=540 bgcolor="white">California</td>
        <td width=60 valign=top bgcolor="white">&nbsp;</td>
      </tr>
      <tr>
        <td width=53 valign=top bgcolor="white">&nbsp;</td>
        <td width=187 bgcolor="white"><h3>ZIP/Postal Code</h3></td>
        <td width=540 bgcolor="white"><?php echo $model->patient->zip; ?></td>
        <td width=60 valign=top bgcolor="white">&nbsp;</td>
      </tr>
      <tr>
        <td width=53 valign=top bgcolor="white">&nbsp;</td>
        <td width=187 bgcolor="white"><h3>Phone</h3></td>
        <td width=540 bgcolor="white"><?php echo $model->patient->phone; ?></td>
        <td width=60 valign=top bgcolor="white">&nbsp;</td>
      </tr>
      <tr>
        <td width=53 valign=top bgcolor="white">&nbsp;</td>
        <td width=187 bgcolor="white"><h3>&nbsp;</h3></td>
        <td width=540 bgcolor="white">&nbsp;</td>
        <td width=60 valign=top bgcolor="white">&nbsp;</td>
      </tr>
      <tr>
        <td width=53 valign=top bgcolor="white">&nbsp;</td>
        <td width=187 bgcolor="white"><h3>Type of donation</h3></td>
        <td width=540 bgcolor="white">Medicinal Collective</td>
        <td width=60 valign=top bgcolor="white">&nbsp;</td>
      </tr>
      <tr>
        <td width=53 valign=top bgcolor="white">&nbsp;</td>
        <td width=187 bgcolor="white"><h3>Weight</h3></td>
        <td width=540 bgcolor="white"><?php echo $model->quantity; ?></td>
        <td width=60 valign=top bgcolor="white">&nbsp;</td>
      </tr>
      <tr>
        <td width=53 valign=top bgcolor="white">&nbsp;</td>
        <td width=187 bgcolor="white"><h3>Contributions Donated</h3></td>
        <td width=540 bgcolor="white"><?php echo $model->total; ?></td>
        <td width=60 valign=top bgcolor="white">&nbsp;</td>
      </tr>
      <tr>
        <td width=840 colspan=4 bgcolor="white"><h4>Thank you for your generosity. We appreciate
            your support!</h4></td>
      </tr>
    </table>
  </div>
</div>
</body>
</html>
