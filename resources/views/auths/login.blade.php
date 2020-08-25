@extends('layouts.base')

@section('content')
<div class="app">
    <Login></Login>
</div>
@endsection

<script>
    import Login from "../../js/src/views/pages/login/Login";
    export default {
        components: {Login}
    }
</script>
