<template>
    <!-- Main content -->
    <section class="content mt-5 pt-5">
        <div class="error-page">
            <h1 class="headline text-warning">404</h1>

            <div class="error-content">
                <h3>
                    <i class="fas fa-exclamation-triangle text-warning"></i>
                    <b>¡Uy! Página no encontrada.</b>
                </h3>

                <p>
                    No pudimos encontrar la página que estabas buscando.
                    Mientras tanto, puede
                    <router-link to="/home">regresar al home </router-link>
                    o intentar usar el formulario de búsqueda.
                </p>

                <!-- <form class="search-form">
                    <div class="input-group">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search"
                        />

                        <div class="input-group-append">
                            <button
                                type="submit"
                                name="submit"
                                class="btn btn-warning"
                            >
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form> -->
            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </section>
    <!-- /.content -->
</template>
