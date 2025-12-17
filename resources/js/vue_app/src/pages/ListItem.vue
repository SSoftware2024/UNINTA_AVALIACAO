<template>
    <div>
        <div class="card mb-3">
            <div class="card-body">
                <form action="">
                    <div class="row">
                        <div class="col-md-12">
                            <select class="form-select" @change="listItemStore.read" v-model="listItemStore.status">
                                <option value="completed">Concluídas</option>
                                <option value="pending" selected>Pendentes</option>
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

        <div class="content">
            <div
                class="card mb-3"
                v-for="item in listItemStore.data"
                :key="item.id"
            >
                <div class="card-body">
                    <!-- Modo edição inline -->
                    <div v-if="editingItemId === item.id">
                        <input type="text" class="form-control mb-2" v-model="editingTitle" />
                        <div class="options d-flex gap-2">
                            <Button
                                text="Salvar"
                                class="btn btn-success"
                                :isLoading="listItemStore.isLoading.update"
                                @click.prevent="saveEdit(item.id)"
                            ></Button>
                            <button class="btn btn-secondary" @click="cancelEdit()">Cancelar</button>
                        </div>
                    </div>

                    <!-- Modo leitura -->
                    <div v-else>
                        <h1>Título {{ item.title }}</h1>
                        <div class="options d-flex gap-2">
                            <button type="button" class="btn btn-warning" @click="editItem(item)">Editar</button>
                            <button type="button" class="btn btn-danger" @click="deleteItem(item.id)">Excluir</button>
                            <Button :text="item.status == 'pending' ? 'Concluir':'Desconcluir'" type="button" :class="{
                                'btn':true,
                                'btn-success': item.status == 'pending',
                                'btn-secondary': item.status == 'completed'
                            }" @click="changeStatus(item.id)" :isLoading="listItemStore.isLoading.changeStatus[item.id]"></Button>
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
            <form @submit.prevent="_register">
                <div class="mb-3">
                    <label class="form-label">Título</label>
                    <input
                        type="text"
                        class="form-control"
                        v-model="listItemStore.title"
                    />
                </div>
                <Button
                    text="Salvar"
                    type="submit"
                    class="btn btn-primary mt-3 d-block"
                    :isLoading="listItemStore.isLoading.register"
                ></Button>
                <div class="text-danger" v-if="listItemStore.errors">
                    <div
                        v-for="(errorMessages, field) in listItemStore.errors"
                        :key="field"
                    >
                        <div v-for="(message, index) in errorMessages" :key="index">
                            {{ message }}
                        </div>
                    </div>
                </div>
            </form>
        </Modal>
    </div>
</template>

<script setup>
import Modal from "@/components/Modal.vue";
import Button from "@/components/Button.vue";
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";
import { useUserStore } from "@stores/user";
import { useListItemStore } from "@stores/listItem";

const route = useRoute();
const userStore = useUserStore();
const listItemStore = useListItemStore();

// Para edição inline
const editingItemId = ref(null);
const editingTitle = ref("");

// Modal
function _closeModal() {
    const modalElement = document.getElementById("createItem");
    const modal = bootstrap.Modal.getInstance(modalElement);
    modal.hide();
}

// Registrar item
async function _register() {
    await listItemStore.register();
    if (!listItemStore.errors) {
        _closeModal();
        listItemStore.task_list_id = route.params.id;
        await listItemStore.read();
    }
}

// Edição inline
function editItem(item) {
    editingItemId.value = item.id;
    editingTitle.value = item.title;
}

function cancelEdit() {
    editingItemId.value = null;
    editingTitle.value = "";
}

async function saveEdit(id) {
    try {
        await listItemStore.update(id, editingTitle.value);
        editingItemId.value = null;
        editingTitle.value = "";
        await listItemStore.read();
    } catch (error) {
        console.log(error);
    }
}
async function changeStatus(id) {
    try {
        await listItemStore.changeStatus(id);
        await listItemStore.read();
    } catch (error) {
        console.log(error);
    }
}

// Exclusão
async function deleteItem(id) {
    try {
        await listItemStore.delete(id);
        await listItemStore.read();
    } catch (error) {
        console.log(error);
    }
}

onMounted(async () => {
    listItemStore.task_list_id = route.params.id;
    await listItemStore.read();
});
</script>
