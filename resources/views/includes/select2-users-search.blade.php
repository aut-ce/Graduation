<select class="js-example-basic-single" name="texter" id="user-name" class="user-name select2">
    @if($default)
        <option value="{{$default['id']}}">{{$default['first_name'].' '.$default['last_name']}}</option>
    @endif
</select>
@push('scripts')
<script>
    $('select#user-name').select2({
        dir: "rtl",
        theme: "bootstrap",
        ajax: {
            url: '{{$select_url}}',
            dataType: 'json',
            delay: 250,
            processResults: function (data, params) {
                params.page = params.page || 1;
                return {
                    results: data
                };
            },
            cache: true
        }
    });
</script>
@endpush