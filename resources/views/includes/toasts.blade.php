<script>
    toastr.options.rtl = true;
    toastr.options.positionClass ='toast-bottom-right';
    @if(isset($errors) && $errors->first())
        toastr.error('{{$errors->first()}}');
    @endif
    @if(session('success'))
        toastr.success('{{session('success')}}');
    @endif
</script>