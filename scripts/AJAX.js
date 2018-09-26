

function selection(file,tabella, Campo, ordine, ricerca){
    $("#id_table").hide();
    $("#id_table").load(file + "?tabella=" + tabella +"&Campo=" + Campo + "&ordine=" + ordine + "&ricerca=" + ricerca);
    $("#id_table").fadeIn(1000);
}

function update(view,tabella,file , id, vet) {
    Link= file + "?tabella=" + tabella + "&id=" + id;
    for(i=0;i<vet.length;i++){
        Link+="&var" + i + "=" + vet[i];
    }
    $("#prova").load(Link, function () {
        $("#error").hide();
        selection("Select.php",view,0);
    });
    
}

function cancella(view,tabella,nomeid,file){
    id=$("input[name='seleziona']:checked").val();
    $("#prova").load("Delete.php?id=" + id + "&tabella=" + tabella + "&NomeId=" + nomeid, function () {
        selection(file,view,0);
    });
}

function aggiungi(view,tabella,file,vet){
    Link= file + "?tabella=" + tabella;
    for(i=0;i<vet.length;i++){
        Link+="&var" + i + "=" + vet[i];
    }
    $("#prova").load(Link, function () {
            selection("Select.php",view,0);
            $("#error").hide();
        });
}

function annulla(){
    $("#error").hide();
}

/*function isValidquantita(quantita){
    //regex per controllare la mail
    pattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return pattern.test(quantita);
}*/

function formAggiorna(view,tabella,tag){
    id=$("input[name='seleziona']:checked").val();
    children=$("input[name='seleziona']:checked").parent().parent().children();
    $("#insert").unbind();
    $("#titolo").text("Modifica un record");
    for(i=0;i<tag.length;i++) 
    {
        if(tag[i][0].tagName!="SELECT")  tag[i].val(children.eq(i+1).html());
        else tag[i][0].options[id].selected = true;
    }
    vet=tag;
    $("#insert").click(function(){
        for(i=0;i<tag.length;i++) vet[i]=tag[i].val();
        update(view,tabella,"Updated.php",id,vet);
    });
}

function formAggiungi(view,tabella,tag){
    $("#insert").unbind();
    for(i=0;i<tag.length;i++) if(tag[i][0].tagName!="SELECT") tag[i].val(""); 

    
    $('#titolo').text("Aggiungi un record");
    vet=tag;
    $("#insert").click(function(){
        for(i=0;i<tag.length;i++) vet[i]=tag[i].val();
        aggiungi(view,tabella,"Aggiungi.php",vet);
    });
}

function info() {
    //imposta il contenuto del paragrafo info sull'evento onmouseover
    $('#info').show();
    $('#info').text('Se vuoi ordinare alfabeticamente la tabella in base ad un campo, premi sulla rispettiva colonna');
}

function resetInfo(){
    //cancella il contenuto del paragrafo info sull'evento onmouseout
    $('#info').hide();
    $('#info').text('');
}
function Abilita(){
    $("#btnDelete").prop("disabled",false);
    $("#btnUpdate").prop("disabled",false);
}