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
        <form @submit.prevent="_register">
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" class="form-control" v-model="taskListStore.title"/>
            </div>
            <Button text="Salvar" type="submit" class="btn btn-primary mt-3 d-block" :isLoading="taskListStore.isLoading.register"></Button>
            <div class="text-danger" v-if="taskListStore.errors">
                <div v-for="(errorMessages, field) in taskListStore.errors" :key="field">
                    <div v-for="(message, index) in errorMessages" :key="index">{{ message }}</div>
                </div>
            </div>
        </form>
    </Modal>
</template>

<script setup>
import Modal from "@/components/Modal.vue";
import Button from "@/components/Button.vue";
import { onMounted } from "vue";
import { useUserStore } from "@stores/user";
import { useTaskListStore } from "@stores/taskList";
const userStore = useUserStore();
const taskListStore = useTaskListStore();

async function _loadUser() {
    await userStore.getUser();
    taskListStore.user_id = userStore.id;
}

function _closeModal(){
    const modalElement = document.getElementById('createList');
    const modal = bootstrap.Modal.getInstance(modalElement);
    modal.hide();
}

function _register(){
    taskListStore.register().then(() => {
        if(!taskListStore.errors){
            _closeModal();
        }
    });
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
