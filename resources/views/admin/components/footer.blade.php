<!-- Filters -->
<style>
    .d-sort, .d-sort-multi{
        cursor: pointer;
    }

    .d-sort .d-label{
        font-weight: 400;
        opacity: .7;
    }
</style>
<script>
    // sort by click
    $(document).on('click', '.d-sort', function(){
        var fullUrl = '{{url()->full()}}'.replaceAll('amp;', '');
        var sort = $(this).data('sort');

        // get clear url
        var url = getUrlWithoutParams(fullUrl);

        // get params
        var params = [];
        if (fullUrl.indexOf('?')>-1){
            params = getParams(fullUrl);
        }

        // set new param
        params = setNewParam(params, 'f', sort);

        // set params
        var openUrl = setParams(url, params);
        
        window.location.href = openUrl;
    });
    // sort multi
    $(document).on('change', '.d-sort-multi select', function(e){
        var fullUrl = '{{url()->full()}}'.replaceAll('amp;', '');

        var sort = e.target.value;

        // empty selected
        if (sort==''){
            return false;
        }

        // get clear url
        var url = getUrlWithoutParams(fullUrl);

        // get params
        var params = [];
        if (fullUrl.indexOf('?')>-1){
            params = getParams(fullUrl);
        }

        // set new param
        params = setNewParam(params, 'f', sort);

        // set params
        var openUrl = setParams(url, params);
        
        window.location.href = openUrl;
    });

    // get url without params
    function getUrlWithoutParams(url)
    {
        if (url.indexOf('?')>-1){
            return url.substr(0, url.indexOf('?'));
        }
        return url;
    }

    // set new param
    function setNewParam(params, name, value){
        var exist = false;
        for (var i=0; i<params.length; i++){
            if (params[i]['name']==name){
                exist = true;
                params[i]['value'] = value;
            }
        }
        if (!exist){
            params.push({name: name, value: value});
        }
        return params;
    }

    // get params
    function getParams(url) {
        var queryString = url.substring(url.indexOf('?') + 1);
        var paramsArr = queryString.split('&');
        var params = [];

        for (var i = 0, len = paramsArr.length; i < len; i++) {
            var keyValuePair = paramsArr[i].split('=');
            params.push({
                name: keyValuePair[0],
                value: decodeURIComponent(keyValuePair[1])
            });
        }

        return params;
    }

    // get params
    function setParams(url, params){
        var finalUrl = url + '?';

        for (var i=0;i<params.length;i++){
            finalUrl+=params[i]['name']+'='+params[i]['value']+'&';
        }

        finalUrl = finalUrl.substr(0, finalUrl.length-1);

        return finalUrl;
    }
</script>

<!-- Alerts -->
<script>
    $(document).on('click', '.btn-danger', function(e){
        if (!window.confirm("{{__('global_delete_alert')}}")){
            e.preventDefault();
            return false;
        }
    });
</script>

<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
<!-- SweetAlert2 -->
<script src="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
</script>

@if (session('status'))
    <script>
        $(document).ready(function (){
            var status = "{{session('status')}}";

            Toast.fire({
                icon: (parseInt(status)==200?'success':'error'),
                title: (parseInt(status)==200?"{{__('global_success')}}":"{{__('global_error')}}")
            })
        });
    </script>
@endif

<!-- /.content-wrapper -->
<footer class="main-footer">
<strong>{{__('footer_right_reserved')}} &copy; <?=date('Y')?>.</strong>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
<!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->