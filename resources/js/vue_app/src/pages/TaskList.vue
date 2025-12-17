<template>
    <div>
        <div class="card mb-3">
            <div class="card-body">
                <button
                    type="button"
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#createList"
                >
                    Cadastrar lista
                </button>
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

    <Modal id="createList" title="Cadastrar Lista">
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
import { useUserStore } from "@stores/user";
const userStore = useUserStore();

async function _loadUser() {
    await userStore.getUser();
}

onMounted(() => {
    _loadUser();
});
</script>
<style scoped>
.content .card:hover {
    background-color: beige;
    cursor: pointer;
}
</style>
