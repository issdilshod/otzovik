/**
 * 
 * @param   {Form} form 
 * @returns {JSON} form
 */
function serializeObject(form){
    var unindexed_array = form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}
