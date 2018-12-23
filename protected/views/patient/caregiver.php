<?php $id=$data['employee_id']; $d1=User::model()->findbyPk($id); $drivername= $d1->name.''.$d1->surname.'('
    .$d1->FullName.')';
$pid=$data['patient_id']; $d2=Patient::model()->findbyPk($pid); $patientname= $d2->name;?>


<div class="row ">  <div class="col-lg-12"> <p align="center"><strong>Designation of Primary Caregiver</strong></p>
<p align="center">As per California Health and Safety Code §11362.5</p>
<p align="center">&nbsp;</p>
<p>I hereby certify that I am a patient diagnosed serious illness for which cannabis provides relief and have obtained a recommendation or approval from a licensed physician in the state of California to use medical cannabis (marijuana) in treating my illness. &nbsp;A copy of my recommendation may be attached hereto.</p>
<p>I understand that my contributions for products I may acquire from this organization are used to ensure continued operation and that this transaction in no way constitutes commercial promotion.</p>
<p>The donation that I contribute is to help the collective continue to provide its members with cannabis for our medicinal needs.</p>
<p><?php echo "OnPoint"; ?> a collective with the medical marijuana in possession of all its members.</p>
<p>I designate <?php echo $drivername; ?> as my provider for my medicinal marijuana.</p>
<p>I hereby designate the individual described below as my Primary Caregiver, in accordance with California Health and Safety Code §11362.5(d) and §11362.5(e), which reads as follows:</p>
<p>&nbsp;</p>
<p>(d) Section 11357, relating to the possession of marijuana, and Section 11358, relating to the cultivation of marijuana, shall not apply to a patient, or to the patient’s primary caregiver, who posses or cultivates marijuana for the personal medical purposes of the patient upon the written or oral recommendation or approval of a physician.</p>
<p>(e) For the purposes of this Section, primary caregiver means the individual designated by the person exempt under this act who has consistently assumed responsibility for the housing, health, or safety of that person.</p>
<p>&nbsp;</p>
<p>I agree that I will consistently rely on the individual described below as the primary source of medical cannabis as a matter of my personal health and safety. &nbsp;This designation shall remain in effect (1) for one year from the date below, (2) until I revoke this designation, or (3) until I designate another individual as my primary caregiver.</p>
<p>&nbsp;</p>
<p>Dated:<?php echo date("l jS \of F Y h:i:s A",strtotime($data['date']));?></p>
<p>&nbsp;</p>
<p><?php echo $patientname; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $drivername; ?></p>
<p>Patient Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Primary Caregiver Name</p>


<p>&nbsp;</p>
<p>&nbsp;</p>
<p>NOTICE TO LAW ENFORCEMENT: Pursuant to the Constitution of the State of California, Amendment III, Section 3.5(c),
    state enforcement officials have no power to refuse to enforce a statute on the basis that federal law or federal
    regulations prohibit the enforcement of such statute. &nbsp;It is therefore your legal duty and responsibility to
    respect and obey this agreement per the above cited legislation, and to leave the individuals herein described
    unmolested and unreported to federal authorities. Failure to follow state law may result in legal action being
    taken against you.</p></div></div>