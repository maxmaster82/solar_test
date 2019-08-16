<template>
    <div class="container">
        <header>
            <nav class="navbar navbar-dark bg-dark">
                <a class="navbar-brand" href="#">
                    <h1>Solar Digital Test</h1>
                </a>
            </nav>
        </header>
        <main>
            <div class="article mt-4">
                <div class="jumbotron">
                    <h2 class="display-4">Hello, world!</h2>
                    <p class="lead">This is an article text.</p>
                </div>
                <Comments />
            </div>
        </main>
    </div>
</template>

<script>
    import Comments from './Comments';

    export default {
        components: {
            Comments
        },
    }
</script>
