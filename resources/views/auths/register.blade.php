@extends('layouts.base')

@section('content')
    <div class="app">
        <register></register>
    </div>
@endsection

<script>
    import Register from "../../js/src/views/pages/register/Register";
    export default {
        components: {Register}
    }
</script>