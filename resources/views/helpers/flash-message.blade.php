@if (session()->has('msg-success'))
    @push('extra_script')
        <script>
            $(document).ready(function() {
                fabNot.showNotification('success','{{ session('msg-success') }}');
            });
        </script>
    @endpush
@endif

@if (session()->has('msg-danger'))
    @push('extra_script')
        <script>
            $(document).ready(function() {
                fabNot.showNotification('danger','{{ session('msg-danger') }}');
            });
        </script>
    @endpush
@endif

@if (session()->has('msg-info'))
    @push('extra_script')
        <script>
            $(document).ready(function() {
                fabNot.showNotification('info','{{ session('msg-info') }}');
            });
        </script>
    @endpush
@endif

@if (session()->has('msg-warning'))
    @push('extra_script')
        <script>
            $(document).ready(function() {
                fabNot.showNotification('warning','{{ session('msg-warning') }}');
            });
        </script>
    @endpush
@endif

@if (session()->has('msg-primary'))
    @push('extra_script')
        <script>
            $(document).ready(function() {
                fabNot.showNotification('primary','{{ session('msg-primary') }}');
            });
        </script>
    @endpush
@endif

@if($errors->any())
    @push('extra_script')
        <script>
            $(document).ready(function() {
                @foreach($errors->all() as $error)
                fabNot.showNotification('danger','{{ $error }}');
                @endforeach
            });
        </script>
    @endpush
@endif
