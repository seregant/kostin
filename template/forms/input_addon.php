<form name="registrasi-addon" method="post" action="../../module/data_input.php" id="addon_form">
 <table width="70%">
   <tr>
     <th colspan="3"><center><h2>Nama Add-on</h2></center></th>
   </tr>
   <tr>
     <td>Nama</td>
     <td>&nbsp;:&nbsp;</td>
     <td><input type="text" name="nama"></td>
   </tr>
   <tr>
     <td>Spesifikasi</td>
     <td>&nbsp;:&nbsp;</td>
     <td><textarea name="spec" form="addon_form" rows="5"></textarea></td>
   </tr>
   <tr>
     <td>Harga</td>
     <td>&nbsp;:&nbsp;</td>
     <td><input type="text" name="price"></td>
   </tr>
   <tr>
     <td>Stok</td>
     <td>&nbsp;:&nbsp;</td>
     <td><input type="text" name="stock"></td>
   </tr>
 </center>
</td>
</tr>
<td colspan="3">
 <center>
   <button type="reset" class="btn btn-sm btn-primary">Reset</button>
   <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
 </center>
</td>
</tr>
</table>
</form>
