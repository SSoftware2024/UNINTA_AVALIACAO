<template>
    <div>
        <div class="card mb-3">
            <div class="card-body">
                <form action="">
                    <div class="row">
                        <div class="col-md-12">
                            <select
                                class="form-select"
                                aria-label="Default select example"
                            >
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <button
                        type="button"
                        class="btn btn-primary mt-2"
                        data-bs-toggle="modal"
                        data-bs-target="#createItem"
                    >
                        Cadastrar Item
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="card mb-3" v-for="value in 10" :key="list">
            <div class="card-body">
                <div>
                    <h1>Título {{ value }}</h1>
                    <div class="options d-flex gap-2">
                        <button type="button" class="btn btn-warning">
                            Editar
                        </button>
                        <button type="button" class="btn btn-danger">
                            Excluir
                        </button>
                        <button type="button" class="btn btn-success">
                            Concluir
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#">Previous</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <Modal id="createItem" title="Cadastrar item">
        <form>
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" class="form-control" />
            </div>
            <button type="submit" class="btn btn-primary mt-3">Salvar</button>
        </form>
    </Modal>
</template>

<script setup>
import Modal from "@/components/Modal.vue";
import { onMounted } from "vue";
import { useRoute } from 'vue-router';

onMounted(() => {
    const route = useRoute();
    console.log(route.params.id);
});
</script>
<style scoped>
.content .card:hover {
    background-color: beige;
    cursor: pointer;
}
</style>
