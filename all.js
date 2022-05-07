$(document).ready(function() {
    $('.minus').click(function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    $('.plus').click(function () {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });
});
function editprofile(){
    document.getElementById("txtphone").contentEditable=true;
    document.getElementById("txtfirstname").contentEditable=true;
    document.getElementById("txtlastname").contentEditable=true;
    document.getElementById("txtcountry").contentEditable=true;
    document.getElementById("txtbio").contentEditable=true;
}
function editpassword(){
    document.getElementById("txtphone").contentEditable=true;
    document.getElementById("txtfirstname").contentEditable=true;
    document.getElementById("txtlastname").contentEditable=true;
    document.getElementById("txtcountry").contentEditable=true;
    document.getElementById("txtbio").contentEditable=true;
}
