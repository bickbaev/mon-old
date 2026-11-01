function edit(id) {
   $.post('/index.php?r=site/fill_est',{data:id},
   function(data){
       $("#name").val(data);
       $("#id_est").val(id);
       $("#mydialog").dialog("open");
       return false;
   });
}
function check() {
        var id = $("#id_est").val();
        var name = $("#name").val();
        $.post('/index.php?r=site/est_check',{id:id, name:name},
        function(data){
        if(data) {
            str="span#s_" + id;                                                            
            $("span#s_" + id).text(name);
            $("#mydialog").dialog("close");
        }
        else alert('Название учреждения может содержать только буквы кириллицы, цифры, пробелы, тире, точку, запятую, кавычки и знак номера');
       });
}