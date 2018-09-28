function selection(file,page,tabella, Campo, ordine, ricerca){
    $("#id_table").hide();
    $("#id_table").load(file + "?page=" + page +"&tabella=" + tabella +"&Campo=" + Campo + "&ordine=" + ordine + "&ricerca=" + ricerca);
    $("#id_table").fadeIn(1000);
    $("#" + tabella).prop("disabled", true).removeClass("btn-danger").addClass("btn-default");    
    $("#" + tabella).removeClass("btn-danger").addClass("btn-default");    
}

function resetResearch(tabella){
    if($("#research").val()=="")selection('Select.php',1,tabella,'0','0','0');
}