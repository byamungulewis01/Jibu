$(function(){
 
$('#phone').keyup(function()
{
var yourInput = $(this).val();
re = /[abcdefghijklmnopqrstuvwxyz`~!@#$%^&*( )_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
var isSplChar = re.test(yourInput);
if(isSplChar)
{
var no_spl_char = yourInput.replace(/[`abcdefghijklmnopqrstuvwxyz~!@#$%^&*( )_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
$(this).val(no_spl_char);
}
});
});
$(function(){
 
$('#Id_number').keyup(function()
{
var yourInput = $(this).val();
re = /[abcdefghijklmnopqrstuvwxyz`~!@#$%^&*( )_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
var isSplChar = re.test(yourInput);
if(isSplChar)
{
var no_spl_char = yourInput.replace(/[`abcdefghijklmnopqrstuvwxyz~!@#$%^&*( )_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
$(this).val(no_spl_char);
}
});
});
$(function(){
 
$('#fullname').keyup(function()
{
var yourInput = $(this).val();
re = /[1234567890`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
var isSplChar = re.test(yourInput);
if(isSplChar)
{
var no_spl_char = yourInput.replace(/[`1234567890~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
$(this).val(no_spl_char);
}
});
 
});
$(function(){
 
$('#lname').keyup(function()
{
var yourInput = $(this).val();
re = /[1234567890`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
var isSplChar = re.test(yourInput);
if(isSplChar)
{
var no_spl_char = yourInput.replace(/[`1234567890~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
$(this).val(no_spl_char);
}
});
$('#fname').keyup(function()
{
var yourInput = $(this).val();
re = /[1234567890`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
var isSplChar = re.test(yourInput);
if(isSplChar)
{
var no_spl_char = yourInput.replace(/[`1234567890~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
$(this).val(no_spl_char);
}
});
 
});

function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Please Uplaod Only Picture');
        fileInput.value = '';
        return false;
    }
};
$(function() {
    $( "#datepicker" ).datepicker({  minDate: new Date() });
});
