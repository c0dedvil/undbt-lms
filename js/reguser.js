$('#nivel').change(function() {
  alert('Handler for .change() called.');
  if $("select option:selected").text() == '4' {
    document.write("<tr><td><div align='right'><b>AREA :</b></div></td>");
  }
});



<tr><td><div align="right"><b>AREA :</b></div></td>
<td><select name="area">
<option value="" selected="selected">Select area ...</option>
<option value="fq">Fisicoquimico</option>
<option value="aa">Absorcion Atomica</option>
<option value="mb">Microbiologia</option>
<option value="gq">Geoquimica</option>
</select></td></tr>
