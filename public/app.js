$( document ).ready(function() {


    /**
     *  Get all checked table rows and add class
     *  name "is-checked"
     */

    $("input:checkbox:checked").closest("tr").addClass("is-checked");


    /**
     * On checkbox check or uncheck add or remove class
     * name "is-checked"
     */

    $('.checkbox').click(function(){
        if($(this).prop("checked") == true){
            $(this).closest("tr").addClass("is-checked");
        }
        else if($(this).prop("checked") == false){
            $(this).closest("tr").removeClass("is-checked");
        }
    });


    /**
     * Show or hide checked or unchecked rows
     * in the table of rules
     */

    $('.search-form input').on('change', function() {

        var value = ($("input[name=search-options]:checked").val());

        if(value == 'checked'){

            $(".table tr:not(:first)").hide();
            
            $(".is-checked").show();

        }else if(value == 'unchecked'){

            $(".table tr").show();
            
            $(".is-checked").hide();

        }else{

            $(".is-checked, table tr").show();

        }
    });


        /*
         * Inicializing data table plugin
         * for filter functionality
         *
         * @TODO add AJAX calls for filtering
         */

        // $('#ruleManagement').DataTable();
        //
        // $('#ruleManagementTwo').DataTable();
        //
        // $('#description-rule-management').DataTable();


    /*
     * AJAX calls for CRUD elements
     *
     * @TODO make constructor function to manage all AJAX calls
     */
    
    /*
     * Laravel helper function for AJAX calls
     */

    $.ajaxSetup({
        headers: {'X-CSRF-Token': $('meta[name=csrf_token]').attr('content')}
    });
    
    

    $('.send-btn').click(function(e) {

        e.preventDefault();

        var data = $('#original').val();
        var datatwo = $('input[name=langtotranslate]:checked').val();

        $.ajax({
            type: "POST",
            url: 'translation-rule-management/translate',
            data: {original:data, language:datatwo},
            dataType: "json",
            success: function(json){

                console.log(json);
                var newValue = json.translated;
                var oldValue = json.new;

                    $('#translation').text('');
                    $('#translation').text(newValue);

                    $('#filteredtext').text('');
                    $('#filteredtext').text(oldValue);

                }
        });

    });

    $(".single-rule").click(function(){

        var dataid = $(this).attr("data-id");
        var url = "translation-rule-management/" + dataid + "/edit";

        $.ajax({
            type: "POST",
            url: url,
            data: dataid,
            success: function(json){
                console.log(json);

                var checked = json.checked;
                var contains_original = json.contains_original;
                var contains_translated = json.contains_translated;
                var contains_not_translated = json.contains_not_translated;
                var search_translated = json.search_translated;
                var replace_translated = json.replace_translated;

                $("input[name='contains_original']").val(contains_original);
                $("input[name='contains_translated']").val(contains_translated);
                $("input[name='contains_not_translated']").val(contains_not_translated);
                $("input[name='search_translated']").val(search_translated);
                $("input[name='replace_translated']").val(replace_translated);

                if(checked == 1) {
                    $("input[name='checked']").attr('checked', 'checked');
                }

                $(".edit-rule").attr("action", url);
                $(".edit-rule").attr("data-id", dataid);

            }

        });

    });

    $(".submit-edit-rule").click(function(e){

        e.preventDefault();


        var updatedataid = $(".edit-rule").attr("data-id");
        var updateUrl = "translation-rule-management/" + updatedataid;

        var update_checked = 0;

        if ($(".is-checked").is(':checked')) {
            update_checked = 1;
        }

        var update_contains_original = $(".contains-original").val();
        var update_contains_translated = $(".contains-translated").val();
        var update_contains_not_translated = $(".contains-not-translated").val();
        var update_search_translated = $(".search-translated").val();
        var update_replace_translated = $(".replace-translated").val();

        $.ajax({
            type:"PATCH",
            url: updateUrl,
            data: {
                checked:update_checked,
                contains_original:update_contains_original,
                contains_translated:update_contains_translated,
                contains_not_translated:update_contains_not_translated,
                search_translated:update_search_translated,
                replace_translated:update_replace_translated
            },
            dataType:"json",
            success: function(json){
                console.log(json);
            }

        });

    });


    // Delete rule with ajax

    $('.delete-rule').click(function (e) {

        e.preventDefault();


        // Getting data id
        var deletedataid = $(".edit-rule").attr("data-id");

        // Setting url for routing
        var delteUrl = "translation-rule-management/" + deletedataid;

        $.ajax({
            type: "DELETE",
            url: delteUrl,
            data: deletedataid,
            success: function(json){
                console.log(json);
            }
        });

    });


    $('#add-description-rule').click(function(){

        // Get form data
        var contains = $('input[name="contains"]').val();
        var not_contains = $('input[name="not_contains"]').val();
        var search_for = $('input[name="search_for"]').val();
        var replace_with = $('input[name="replace_with"]').val();

        // URL for route
        var url = 'description-rule-management/create';

        $.ajax({
           type: "POST",
            url: url,
            data: {
                contains:contains,
                not_contains:not_contains,
                search_for:search_for,
                replace_with:replace_with
            },
            success: function(json){
                console.log(json);
                var linas = json.added.contains;
                $('#description-rule-management tbody').append('<tr>' +
                    '<td></td>' +
                    '</td>' +
                    '<td>' + linas + '</td>' +
                    '<td>json.not_contains</td>' +
                    '<td>json.search_for</td>' +
                    '<td>json.replace_with</td>' +
                    '<td>Edit</td></tr>')
            }
        });

    });


    // Open Description rule modal and data in

    $(".edit-description").click(function(e) {

        e.preventDefault();

        var dataid = $(this).attr("data-id");

        $(".edit-description-form").attr("data-id", dataid);

        var url = "description-rule-management/" + dataid + "/edit";

        $.ajax({
            type: "POST",
            url: url,
            data: dataid,
            success: function(json){
                console.log(json);

                //Clean up the form
                $('.contains').val();

                $('.not-contains').val();

                $('.search-for').val();

                $('.replace-with').val();

                // Get row values
                var approved = json.checked;

                var contains = json.contains;

                var notcontains = json.not_contains;

                var searchfor = json.search_for;

                var replacewith = json.raplace_with;


                //Set row values
                if(approved == 1){
                    $('.approved').attr('checked', 'checked');
                }else{
                    $('.approved').removeAttr('checked', 'checked');
                }

                $('.contains').val(contains);

                $('.not-contains').val(notcontains);

                $('.search-for').val(searchfor);

                $('.replace-with').val(replacewith);

            }
        });


    });


    $(".save-description").click(function(e){

        e.preventDefault();


        var updatedataid = $(".edit-description-form").attr("data-id");
        var updateUrl = "description-rule-management/" + updatedataid;

        var update_checked = 0;

        if ($(".approved").is(':checked')) {
            update_checked = 1;
        }

        var update_contains = $(".contains").val();
        var update_not_contains = $(".not-contains").val();
        var update_search_for = $(".search-for").val();
        var update_replace_width = $(".replace-with").val();

        $.ajax({
            type:"PATCH",
            url: updateUrl,
            data: {
                checked:update_checked,
                contains:update_contains,
                not_contains:update_not_contains,
                search_for:update_search_for,
                replace_with:update_replace_width
            },
            dataType:"json",
            success: function(json){
                console.log(json);
            }

        });

    });



    // Delete description rule AJAX call

    $('.delete-description').click(function (e) {

        e.preventDefault();


        // Getting data id
        var deletedataid = $(".edit-description-form").attr("data-id");

        // Setting url for routing
        var deleteUrl = "description-rule-management/" + deletedataid;

        $.ajax({
            type: "DELETE",
            url: deleteUrl,
            data: deletedataid,
            success: function(json){
                console.log(json);
            }
        });

    });



    $('.send-description-btn').click(function(e) {

        e.preventDefault();

        var data = $('#original').val();

        $.ajax({
            type: "POST",
            url: 'description-rule-management/translate',
            data: {original:data},
            dataType: "json",
            success: function(json){

                console.log(json);
                var newValue = json.translated;
                var oldValue = json.new;

                $('#translation').text('');
                $('#translation').text(newValue);

                $('#filteredtext').text('');
                $('#filteredtext').text(oldValue);

            }
        });

    });



    var selectedlanguages = $('input[name="translations"]:checked').val();

    if(selectedlanguages == 'detoen'){
        $('input[name="original_language_id"]').val(1);
        $('input[name="translated_language_id"]').val(2);
        $('#ruleManagement_wrapper, #ruleManagement').show();
        $('#ruleManagementTwo_wrapper, #ruleManagementTwo ').hide();
    } else {
        $('input[name="original_language_id"]').val(2);
        $('input[name="translated_language_id"]').val(1);
        $('#ruleManagement_wrapper, #ruleManagement').hide();
        $('#ruleManagementTwo_wrapper, #ruleManagementTwo').show();
    }


    $( 'input[name="translations"]' ).change(function () {

        var selectedlanguages = $('input[name="translations"]:checked').val();

        if(selectedlanguages == 'detoen'){
            $('input[name="original_language_id"]').val(1);
            $('input[name="translated_language_id"]').val(2);
            $('#ruleManagementTwo_wrapper, #ruleManagementTwo').hide();
            $('#ruleManagement_wrapper, #ruleManagement').show();
        } else {
            $('input[name="original_language_id"]').val(2);
            $('input[name="translated_language_id"]').val(1);
            $('#ruleManagementTwo_wrapper, #ruleManagementTwo').show();
            $('#ruleManagement_wrapper, #ruleManagement').hide();
        }

    })
    

    // Keyword controls

    $('.continuous-form, .verb-variant, .other-variant').hide();

    // display form according to word type selected
    $('select.word-types').change(function(){

        var valueChosen = $(this).val();

        var substantive = 'substantive';

        var verb = 'verb';

        var other = "other";

        if(valueChosen == substantive){
            $('.continuous-form, .verb-variant, .other-variant').hide(); 
            $('.latin-name, .local-lang, .plural-form').show();
        }else if(valueChosen == verb){
            $('.latin-name, .local-lang, .plural-form, .other-variant').hide();
            $('.continuous-form, .verb-variant').show();
        }else{
            $('.latin-name, .local-lang, .plural-form, .continuous-form, .verb-variant').hide();
            $('.other-variant').show();
        }

    });


    // Dummy toggle. Temporarily!!

    $('.keyword-set').hide();

    $('.add-keyword-set').click(function(){
        $('.keyword-set').show();
    });

    // Create synonyms

    $('.add-synonym-en').click(function(){

        var synonymSubstEn = "<div class='synonym-container-en'><input class='form-control' name='keyword_en[]' placeholder='Main keyword in english' type='text'><input class='form-control plural-form' name='plural_de[]' type='text' placeholder='Plural form'></div>";

        var synonymVerbEn = "<input class='form-control' name='keyword_en[]' placeholder='Main keyword in english' type='text'><input class='form-control continuous-form' name='continuous_de[]' type='text' placeholder='Continuous form'><input class='form-control verb-variant' name='variant[]' type='text' placeholder='Variant'>";

        var synonymOtherEn = "<input class='form-control' name='keyword_en[]' placeholder='Main keyword in english' type='text'><input class='form-control variant' name='variant[]' type='text' placeholder='Variant'>";


            $(".en-block").append(synonymSubstEn);


    });

    // Post keyword form
    
    $('.add-keyword-set').click(function(){

        var url = "keyword-tree/create";

        $('form.add-keyword-set').attr('action', url);

        // var checked = "0";
        //
        // var type = $('.keyword-set select.word-types').val();
        //
        // var latin = $('.latin-name').val();
        //
        // var local_lang = $('.local-lang').val();
        //
        // var keyword_de = JSON.stringify($('input[name="keyword_de[]"]'));
        //
        // var keyword_en = JSON.stringify($('input[name="keyword_en[]"]'));
        //
        // var plural_de = JSON.stringify($('input[name="plural_de[]"]'));
        //
        // var plural_en = JSON.stringify($('input[name="plural_en[]"]'));
        //
        // var formData = $(this).serialize();
        //
        // var synonymForm = '0';

        //var data = $('.new-keyword-form').serialize();

        $.ajax({
            type: "POST",
            url: url,
            data: $('.new-keyword-form').serialize(),
            success: function(json){
                //console.log(json);

                var id = json.id;

                $(".keyword-id").text(json.id);

                $('.add-keyword-set').closest('form').attr("action", 'keyword-tree/' + id);

                $('.add-keyword-set').closest('form').attr("data-id", id);

            }

        });

    });

    // Update Keyword form

    $('.new-keyword-form').change(function(){

        var url = $(this).attr('action');

        // Get all form values

        var wordtype_en = $(this).find("input[name='keyword_en']").val();

        var wordtype_de = $(this).find("input[name='keyword_de']").val();

        var wordtype = $(this).find(".word-types").val();

        var check = 0;

        if ($("input[name='checked']").is(':checked')) {
            check = 1;
        }


        $.ajax({
            type: "PATCH",
            url: url,
            data: {
                checked: check,
                keyword_en: wordtype_en,
                keyword_de: wordtype_de,
                type:wordtype
            },
            success: function(json){
                console.log(json);
            }
        });

    });
    
}); //END document ready block