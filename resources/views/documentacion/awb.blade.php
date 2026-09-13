<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>

	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
	<title></title>
	<meta name="AWB" />
	<meta name="author" content="Jota"/>
	<meta name="created" content="2006-06-30T20:22:58"/>
	<meta name="changedby" content="Jaen"/>
	<meta name="changed" content="2022-07-22T00:58:15"/>

	<style type="text/css">
	body,div,table,thead,tbody,tfoot,tr,th,td,p {
    font-family: "Arial";
    font-size: 10px
    }
    .header1{
        font-size: 12px;
    }
    </style>

</head>

<body>

    @foreach ($awbs as $data )
        @foreach ($data as $awb )
<table width="670px" border="0" align="center" cellspacing="0"  style="border-right: 1px solid #000000; ">
<tr><td>
	<table width="100%" border="0" align="center" cellspacing="0" style="border-right: 1px; font-size: 8px;">



		<tr>
			{{-- <td width="1" height="17" align="left"><b><br></b></td> --}}
			<td width="37" align="left" valign="bottom" class="header1" style="border-bottom: 1px solid #000000"><b>AWB</b></td>
			<td colspan=2 align="center" valign="bottom" class="header1" style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"><b>SCL</b></td>
			<td colspan=19 align="left" valign="bottom" bgcolor="#FFFFFF" class="header1" style="border-bottom: 1px solid #000000; border-left: 1px solid #000000"><b>{{$awb->mawb}}</b><b><br></b></td>
			<td colspan=4 align="right" valign="bottom" bgcolor="#FFFFFF" class="header1" style="border-bottom: 1px solid #000000"><b>{{ $awb->hawb}}</b></td>
		</tr>
		<tr>
			{{-- <td height="12" align="left"><br></td> --}}
			<td colspan=9 align="left" valign="top" bgcolor="#FFFFFF" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">Shipper&acute;s  Name and Address</td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=7 align="left" valign=top bgcolor="#FFFFFF">Account No.</td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;" colspan=10 align="left" bgcolor="#FFFFFF">Not Negotiable</td>
		</tr>
		<tr>
			{{-- <td height="21" align="left"><br></td> --}}
			<td colspan=9 align="left" bgcolor="#FFFFFF" style="border-left: 1px solid #000000; font-size: 10px;"><b>{{ $awb->shipper}}</b></td>
		  <td colspan=7 align="left" bgcolor="#FFFFFF" style="border-left: 1px solid #000000; border-bottom: 1px solid #000000"><b><br></b></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 12px;" colspan=10 align="left" valign=top bgcolor="#FFFFFF"><b><i>AIR Waybill</i></b></td>
		</tr>
		<tr>
			{{-- <td height="38" align="left"></td> --}}
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=16 rowspan=2 align="left" valign=top>
				<span style="font-size: 10px">{{ $awb->shipid}}</span><br>
				<span style="font-size: 10px">{{ $awb->shiptelefono}}</span><br>
				<span style="font-size: 10px">{{ $awb->dirshipper}}</span><br>
				<span style="font-size: 10px">{{ $awb->shipemail}}</span><br>
			</td>
			<!-- min-width: 1000px; -->
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=10 align="left" valign=middle bgcolor="#FFFFFF">&nbsp;</td>
		</tr>
		<tr>
			{{-- <td height="20" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=10 align="left">Copies 1,2 and 3 of this Air WayBill are originals and have the same validity</td>
			</tr>
		<tr>
			{{-- <td height="19" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=9 align="left" valign=top bgcolor="#FFFFFF">Consignee&acute;s Name and Address</td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; max-height: 25px" colspan=7 align="left" valign=top bgcolor="#FFFFFF">Account No.</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px; text-align: justify;" colspan=10 rowspan=5 align="justify" valign=top>It is agreed that the goods described herein are accepted in apparent good order and condition (except as noted) for carriage  SUBJECT TO THE CONDITIONS OF CONTRACT ON THE REVERSE HEREOF ALL GOODS MAY BE CARRIER UNLESS SPECIFIC CONTRARY INSTRUCTIONS ARE GIVEN HEREON BY THE SHIPPER, AND SHIPPER AGREES THAT THE SHIPMENT MAY BE CARRIED VIA INTERMEDIATE STOPPING PLACES WHICH THE CARRIER DEEMS APPROPIATE  THE LIABILITY. Shipper may increase such limitation of liability by declaring a higher value for carriage and paying a supplemental charge  if required</td>
			</tr>
		<tr>
			{{-- <td height="20" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td colspan="9" align="left" bgcolor="#FFFFFF" style="border-left: 1px solid #000000; font-size: 10px;"><b>{{ $awb->consignee}}</b><b><br></b><b><br></b></td>
			<td colspan="7" align="left" bgcolor="#FFFFFF" style="border-bottom: 1px solid #000000; border-left: 1px solid #000000">&nbsp;</td>
			</tr>
		<tr>
			{{-- <td height="20" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td colspan=16 rowspan="3" align="left" bgcolor="#FFFFFF" style="border-left: 1px solid #000000; border-right: 1px solid #000000">
				<span style="font-size: 10px">{{ "ID: ".$awb->ci."   PH:".$awb->telefono}}</span><br>
				<span style="font-size: 10px">{{ $awb->direccion.", ".$awb->municipio.", ".$awb->provincia}}</span><br>
				<span style="font-size: 10px">{{ "ZONA ".$awb->provincia." (".$awb->rutas.")"}}</span><br>
				{{-- <span style="font-size: 10px">{{ "PH:".$awb->telefono}}</span><br> --}}
				<span style="font-size: 10px">{{ $awb->email}}</span><br>
			</td>
			</tr>
		<tr>
			{{-- <td height="20" align="left" bgcolor="#FFFFFF"><br></td> --}}		</tr>
		<tr>
			{{-- <td height="20" align="left" bgcolor="#FFFFFF"><br></td> --}}		</tr>
		<tr>
			{{-- <td height="15" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=16 align="left" valign=top bgcolor="#FFFFFF">Issuing Carrier&acute;s Agent Name and City</td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=10 align="left" bgcolor="#FFFFFF">Notify</td>
			</tr>
		<tr>
			{{-- <td height="48" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=16 align="left" valign=middle bgcolor="#FFFFFF"><p>SOCIEDAD COMERCIAL H.A.R. LIMITADA</p></td>
			<!-- min-width: 550px;-->
		  <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=10 rowspan=5 align="left" valign=middle bgcolor="#FFFFFF"><!--<b><br></b></td> -->
		  {{-- <td colspan=16 rowspan="3" align="left" bgcolor="#FFFFFF" style="border-left: 1px solid #000000; border-right: 1px solid #000000"> --}}
			<span style="font-size: 10px">{{ $awb->consignee}}</span><br>
			<span style="font-size: 10px">{{ "ID: ".$awb->ci."   PH:".$awb->telefono}}</span><br>
			<span style="font-size: 10px">{{ $awb->direccion.", ".$awb->municipio.", ".$awb->provincia}}</span><br>
			<span style="font-size: 10px">{{ "ZONA ".$awb->provincia." (".$awb->rutas.")"}}</span><br>
			{{-- <span style="font-size: 10px">{{ "PH:".$awb->telefono}}</span><br> --}}
			<span style="font-size: 10px">{{ $awb->email}}</span><br>
			</td>
			</tr>
		<tr>
			{{-- <td height="13" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=8 align="left" valign=top bgcolor="#FFFFFF">Agent&acute;s IATA Code</td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=8 align="left" bgcolor="#FFFFFF">Account No.</td>
			</tr>
		<tr>
			{{-- <td height="16" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=8 align="left" bgcolor="#FFFFFF">&nbsp;</td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=8 align="left" bgcolor="#FFFFFF"><b><br></b></td>
			</tr>
		<tr>
			{{-- <td height="14" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=16 align="left" bgcolor="#FFFFFF">Airport of Departure (Addr. Of First Carrier) and Requested Routing</td>
			</tr>
		<tr>
			{{-- <td height="18" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 10px;" colspan=16 align="left" bgcolor="#FFFFFF"><b>{{ $awb->portorigen}} </b></td>
			</tr>
		<tr>
			{{-- <td height="11" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" align="left" bgcolor="#FFFFFF">To</td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" colspan=3 align="center" bgcolor="#FFFFFF">By First Carrier</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" colspan=5 align="center" bgcolor="#FFFFFF">Routing and destination</td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" colspan=2 align="center" bgcolor="#FFFFFF">to</td>
			<td width="20" align="left" bgcolor="#FFFFFF" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">by</td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" bgcolor="#FFFFFF">to</td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" bgcolor="#FFFFFF">by</td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" bgcolor="#FFFFFF"><br></td>
			<td width="35" align="center" bgcolor="#FFFFFF" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;">CHGS </td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" colspan=2 align="center" bgcolor="#FFFFFF">WT / VAL</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" colspan=2 align="center" bgcolor="#FFFFFF">Others</td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" colspan=2 align="center" bgcolor="#FFFFFF">Declared Value for carriage</td>
			<td width="77" align="center" bgcolor="#FFFFFF" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">Declare Value for customs</td>
		</tr>
		<tr>
			{{-- <td height="13" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 10px;" rowspan=2 align="left" bgcolor="#FFFFFF"><b>{{ $awb->destino}}</b></td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 10px;" colspan=8 rowspan=2 align="left" bgcolor="#FFFFFF"><b>{{ $awb->aerolinea}}</b></td>
		  <td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 rowspan=2 align="center" bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 rowspan=2 align="center" bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: px solid #000000" colspan=2 rowspan=2 align="center" bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 rowspan=2 align="center" bgcolor="#FFFFFF"><b>USD</b></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" align="center" bgcolor="#FFFFFF">CODE</td>
			<td width="24" align="center" bgcolor="#FFFFFF" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;">PPD</td>
			<td width="22" align="center" bgcolor="#FFFFFF" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;">COLL</td>
			<td width="22" align="center" bgcolor="#FFFFFF" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;">PPD</td>
			<td width="22" align="center" bgcolor="#FFFFFF" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;">COLL</td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 rowspan=2 align="center" bgcolor="#FFFFFF"><b>N.V.D</b></td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" bgcolor="#FFFFFF" sdnum="1033;0;&quot;$&quot;#,##0.00"><b><br></b></td>
		</tr>
		<tr>
			{{-- <td height="16" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" bgcolor="#FFFFFF"><b>PP</b></td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" bgcolor="#FFFFFF"><b>x</b></td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" bgcolor="#FFFFFF"><b>x</b></td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" bgcolor="#FFFFFF"><b><br></b></td>
			</tr>
		<tr>
			{{-- <td height="17" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=8 align="center" valign=top bgcolor="#FFFFFF">Airport of Destination</td>
			<td width="46" align="center" valign=top bgcolor="#FFFFFF" style="border-top: 1px solid #000000">Flight / Date</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="center" valign=top bgcolor="#FFFFFF">For Carrier Use Only</td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=top bgcolor="#FFFFFF">Flight / Date</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=6 align="center" valign=top bgcolor="#FFFFFF">Amount of Insurance</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" colspan=4 rowspan=2 align="justify" valign=top bgcolor="#FFFFFF">INSURANCE: If carriers offers insurance, and such insurance is requested in accordance with the conditions thereof, indicate amount to be insured in figures in box marked. &quot;Amount of Insurance&quot;</td>
			</tr>
		<tr>
			{{-- <td height="26" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 10px;" colspan=8 align="center" bgcolor="#FFFFFF"><b>{{ substr($awb->portdestino,0,20)}}</b></td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 10px;" colspan=3 align="left" bgcolor="#FFFFFF"><b>{{ $awb->aeronave." ".$awb->vuelo}}</b></td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" bgcolor="#FFFFFF" sdnum="1033;1033;D-MMM"><b>{{ $awb->fecha ? Carbon\Carbon::parse($awb->fecha)->format('M d, Y'): '' }}</b></td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=6 align="center" bgcolor="#FFFFFF"><b>NIL</b></td>
			</tr>
		<tr>
			{{-- <td height="16" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=26 align="left" valign=top bgcolor="#FFFFFF">Handling Information </td>
			</tr>
		<tr>
			{{-- <td height="18" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td colspan=26 rowspan="4" align="left" bgcolor="#FFFFFF" style="border-left: 1px solid #000000; border-right: 1px solid #000000"><p>BULTO: <span>{{$awb->bulto."/".$awb->cantidad}}</span></p></td>
			</tr>
		<tr>
		{{-- <td height="18" align="left" bgcolor="#FFFFFF"><br></td> --}}		</tr>
		<tr>
			{{-- <td height="18" align="left" bgcolor="#FFFFFF"><br></td> --}}		</tr>
		<tr>
			{{-- <td height="20" align="left" bgcolor="#FFFFFF"><br></td> --}}		</tr>
		<tr>
			{{-- <td height="18" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" rowspan=2 align="center" bgcolor="#FFFFFF">No. Of Pieces RCP</td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" colspan=3 rowspan=2 align="center" valign=middle bgcolor="#FFFFFF">Gross       Weight</td>
			<td width="15" rowspan=2 align="center" valign=middle bgcolor="#FFFFFF" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;">kg  lb </td>
			<td width="3" rowspan=10 align="center" bgcolor="#C0C0C0" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"><br></td>
			<td width="2" align="left" bgcolor="#FFFFFF" style="border-top: 1px solid #000000"><br></td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" colspan=3 align="center" valign=middle bgcolor="#FFFFFF">Rate Class</td>
			<td width="5" rowspan=9 align="center" bgcolor="#C0C0C0" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"><br></td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" colspan=2 rowspan=2 align="center" valign=top bgcolor="#FFFFFF">Chargeable  weight </td>
			<td width="3" rowspan=9 align="center" bgcolor="#C0C0C0" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"><br></td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" colspan=3 rowspan=2 align="center" valign=top bgcolor="#FFFFFF">Rate  /  Charge </td>
			<td width="13" rowspan=10 align="center" bgcolor="#C0C0C0" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"><br></td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" colspan=5 rowspan=2 align="center" valign=top bgcolor="#FFFFFF">Total </td>
			<td width="32" rowspan=10 align="center" bgcolor="#C0C0C0" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"><br></td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" colspan=2 align="center" valign=top bgcolor="#FFFFFF">Nature and Quantity of Goods</td>
			</tr>
		<tr>
			{{-- <td height="20" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-right: 1px solid #000000" align="left" bgcolor="#FFFFFF"><br></td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" colspan=3 align="center" valign=middle bgcolor="#FFFFFF">Commodity                         Item   No.</td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" colspan=2 align="center" valign=top bgcolor="#FFFFFF">(incl. Dimensions of Volume)</td>
			</tr>
		<tr>
			{{-- <td height="17" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=top bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-top: 1px solid #000000" colspan=3 align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-left: 1px solid #000000" align="center" valign=top bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle bgcolor="#FFFFFF"><br></td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" valign=middle bgcolor="#FFFFFF" sdnum="1033;0;#,##0.00"><b><br></b></td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=top bgcolor="#FFFFFF"><b><br></b></td>
			</tr>
		<tr>
			{{-- <td height="18" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=top bgcolor="#FFFFFF"><b><br></b></td>
			<td colspan=3 align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td align="left" bgcolor="#FFFFFF"><br></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle bgcolor="#FFFFFF"><br></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=top bgcolor="#FFFFFF"><b><br></b></td>
			</tr>
		<tr>
			{{-- <td height="20" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" align="center" valign=middle bgcolor="#FFFFFF" sdval="42" sdnum="1033;"><b>{{ $awb->cantidadpiezas}}</b></td>
			<td colspan=3 align="center" valign=middle bgcolor="#FFFFFF"><b>{{ number_format($awb->gross,2)}}</b></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td align="left" bgcolor="#FFFFFF"><br></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" colspan=3 align="center" valign=middle bgcolor="#FFFFFF"><b>KG</b></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle bgcolor="#FFFFFF" sdval="178" sdnum="1033;">&nbsp;</td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" colspan=3 align="center" valign=middle bgcolor="#FFFFFF" sdval="2.08" sdnum="1033;"><b>AS AGREE</b></td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" colspan=5 align="center" valign=middle bgcolor="#FFFFFF" sdval="370.24" sdnum="1033;0;#,##0.00"><b>AS AGREE</b></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" colspan=2 align="center" valign=top bgcolor="#FFFFFF"><b>{{ $awb->descripcion}}</b></td>
			</tr>
		<tr>
			{{-- <td height="20" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=top bgcolor="#FFFFFF"><b><br></b></td>
			<td colspan=3 align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td align="left" bgcolor="#FFFFFF"><br></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle bgcolor="#FFFFFF"><br></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=top bgcolor="#FFFFFF">&nbsp;</td>
			</tr>
		<tr>
			{{-- <td height="20" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=top bgcolor="#FFFFFF"><b><br></b></td>
			<td colspan=3 align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td align="left" bgcolor="#FFFFFF"><br></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle bgcolor="#FFFFFF"><br></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px" colspan=2 align="center" valign=top bgcolor="#FFFFFF"></td>
			</tr>
		<tr>
			{{-- <td height="20" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=top bgcolor="#FFFFFF"><b><br></b></td>
			<td width="13" align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td width="12" align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td width="14" align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td align="left" bgcolor="#FFFFFF"><br></td>
			<td width="8" align="center" valign=middle bgcolor="#FFFFFF" style="border-left: 1px solid #000000"><br></td>
			<td align="center" valign=middle bgcolor="#FFFFFF"><br></td>
			<td width="2" align="center" valign=middle bgcolor="#FFFFFF" style="border-right: 1px solid #000000"><br></td>
			<td style="border-left: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td width="22" align="center" valign=middle bgcolor="#FFFFFF" style="border-right: 1px solid #000000"><b><br></b></td>
			<td width="13" align="center" valign=middle bgcolor="#FFFFFF" style="border-left: 1px solid #000000"><b><br></b></td>
			<td width="35" align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td width="5" align="center" valign=middle bgcolor="#FFFFFF" style="border-right: 1px solid #000000"><b><br></b></td>
			<td style="border-left: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=top bgcolor="#FFFFFF"><b><br></b></td>
			</tr>
		<tr>
			{{-- <td height="20" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=top bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-bottom: 1px solid #000000" colspan=3 align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=top><b><br></b></td>
			<td style="border-left: 1px solid #000000" align="center" valign=top bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle bgcolor="#FFFFFF"><br></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=top bgcolor="#FFFFFF"><b><br></b>{{$awb->codigoenvio}}</td>
			</tr>
		<tr>
			{{-- <td height="23" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" align="center" valign=top sdval="42" sdnum="1033;"><b>{{ $awb->cantidad}}</b></td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" colspan=3 align="center" valign=top><b>{{ $awb->gross}}</b></td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=top><b><br></b></td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center" valign=top bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle bgcolor="#FFFFFF"><br></td>
			<td align="left" bgcolor="#C0C0C0"><br></td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td align="left" bgcolor="#C0C0C0"><br></td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle bgcolor="#FFFFFF"><b><br></b></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" colspan=5 align="center" sdval="370.24" sdnum="1033;0;&quot;$&quot;#,##0.00"><b>AS AGREE</b></td>
			<td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000; font-size: 8px;" colspan=2 align="center" valign=middle bgcolor="#FFFFFF"><b>{{ $awb->cantidad." BULTOS"}}</b></td>
			</tr>
		<tr>
			{{-- <td height="17" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" colspan=2 align="center">Prepaid</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" colspan=6 align="center">Weight Charge</td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" colspan=2 align="center">Collect </td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; font-size: 8px;" colspan=16 align="left" bgcolor="#FFFFFF">Other Charges </td>
			</tr>
		<tr>
			{{-- <td height="21" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" sdval="370.24" sdnum="1033;0;&quot;$&quot;#,##0.00"><b>AS AGREE</b></td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" sdnum="1033;0;&quot;$&quot;#,##0.00"><b><br></b></td>
			<td colspan=16 rowspan="5" align="left" valign=top bgcolor="#FFFFFF" style="border-left: 1px solid #000000; border-right: 1px solid #000000">&nbsp;</td>
		</tr>
		<tr>
			{{-- <td height="16" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center"><br></td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=6 align="center">Valuation Charge</td>
			<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center"><br></td>
		</tr>
		<tr>
			{{-- <td height="17" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan=5 align="center" sdnum="1033;0;#,##0.00"><b><br></b></td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" sdnum="1033;0;#,##0.00"><b><br></b></td>
		</tr>
		<tr>
			{{-- <td height="22" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center"><br></td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=6 align="center">Tax</td>
			<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center"><br></td>
		</tr>
		<tr>
			{{-- <td height="27" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan=5 align="center"><b><br></b></td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center"><b><br></b></td>
			</tr>
		<tr>
			{{-- <td height="21" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000" align="center"><br></td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=8 align="center">Total Others Charges Due Agent</td>
			<td style="border-top: 1px solid #000000" align="center"><br></td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=16 rowspan=2 align="justify" valign=top bgcolor="#FFFFFF">Shipper certifies that the particulars on the face hereof  are correct and that insofar as any part of the consignment contains dangerous goods, such part is properly described by name and is in proper condition for carriage by air according to the applic</td>
			</tr>
		<tr>
			{{-- <td height="25" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan=5 align="center" sdval="75.94" sdnum="1033;0;#,##0.00">&nbsp;</td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan=5 align="center" sdnum="1033;0;#,##0.00"><b><br></b></td>
			</tr>
		<tr>
			{{-- <td height="13" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" rowspan=2 align="center"><br></td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=8 rowspan=2 align="center">Total Others Charges Due Carrier</td>
			<td style="border-top: 1px solid #000000" rowspan=2 align="center"><br></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=16 rowspan=2 align="center" bgcolor="#FFFFFF"><b><br></b></td>
			</tr>
		<tr>
			{{-- <td height="11" align="left" bgcolor="#FFFFFF" style="border-rigth: 1px solid #000000;"><br></td> --}}
			</tr>
		<tr>
			{{-- <td height="20" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" sdval="62.84" sdnum="1033;0;#,##0.00">&nbsp;</td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan=5 align="center" sdnum="1033;0;&quot;$&quot;#,##0.00"><b><br></b></td>
			<td style="border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=16 align="center" bgcolor="#FFFFFF"><b>SOCIEDAD COMERCIAL HAR LIMITADA</b></td>
			</tr>
		<tr>
			{{-- <td height="13" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" bgcolor="#C0C0C0"><br></td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan=5 align="center" bgcolor="#C0C0C0"><br></td>
			<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=16 align="center" valign=top bgcolor="#FFFFFF">Signature of Shippers or his Agent</td>
			</tr>
		<tr>
			{{-- <td height="17" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center">Total Prepaid</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center">Total Collect</td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=16 rowspan=2 align="center"><br></td>
			</tr>
		<tr>
			{{-- <td height="19" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" sdval="509.02" sdnum="1033;0;&quot;$&quot;#,##0.00"><b>AS AGREE</b></td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" sdnum="1033;0;&quot;$&quot;#,##0.00"><b><br></b></td>
			</tr>
		<tr>
			{{-- <td height="17" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center">Currency Coversion Rates</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center">CC Charges in Dest. Currency</td>
			<td style="border-bottom: 1px dotted #000000; border-left: 1px solid #000000" colspan=6 align="center" bgcolor="#FFFFFF" sdnum="1033;1033;D-MMM-YY"><b>{{ Carbon\Carbon::parse($awb->fecha)->format('M d, Y')}}</b></td>
			<td style="border-bottom: 1px dotted #000000" colspan=7 align="center" bgcolor="#FFFFFF"><b>SCL.</b></td>
			<td style="border-bottom: 1px dotted #000000; border-right: 1px solid #000000; font-size: 9px;" colspan=3 align="center" bgcolor="#FFFFFF"><b>SOCIEDDA COMERCIAL HAR LTD</b></td>
			</tr>
		<tr>
			{{-- <td height="17" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" sdnum="1033;0;#,##0.00"><b><br></b></td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" sdnum="1033;0;#,##0.00"><b><br></b></td>
			<td style="border-top: 1px dotted #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=16 align="left">      Executed on (date)                                     at (place)                                              Signature of issuing Carrier or its Agent</td>
			</tr>
		<tr>
			{{-- <td height="17" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 rowspan=2 align="center" valign=middle>For Carrier Use Only  at Destination</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center">Charges at Destination</td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center">Total Collect Charges</td>
			<td style="border-top: 1px solid #000000; border-left: 1px solid #000000" colspan=11 align="center" bgcolor="#FFFFFF"><br></td>
			</tr>
		<tr>
			{{-- <td height="19" align="left" bgcolor="#FFFFFF"><br></td> --}}
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" sdnum="1033;0;#,##0.00"><b><br></b></td>
			<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" sdnum="1033;0;#,##0.00"><b><br></b></td>
			<td style="border-left: 1px solid #000000" colspan=9 align="center" bgcolor="#FFFFFF"><br></td>
			<td colspan=2 align="right" bgcolor="#FFFFFF"><b>{{$awb->mawb}}</b></td>
			</tr>
	
	</table>
</td></tr>
</table>

@endforeach
@endforeach
</body>
</html>
