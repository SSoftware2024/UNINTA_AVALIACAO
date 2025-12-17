<template>
  <div>
    <!-- Botão para criar nova lista -->
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

    <!-- Lista de tarefas -->
    <div class="contents">
      <div class="card mb-3" v-for="task in taskListStore.data" :key="task.id">
        <div class="card-body">
          <!-- Modo edição -->
          <div v-if="editingTaskId === task.id">
            <input type="text" class="form-control mb-2" v-model="editingTitle" />
            <div class="options d-flex gap-2">
              <Button text="Salvar" class="btn btn-success" :isLoading="taskListStore.isLoading.update" @click="saveEdit(task.id)"></Button>
              <button class="btn btn-secondary" @click="cancelEdit()">Cancelar</button>
            </div>
          </div>

          <!-- Modo leitura -->
          <div v-else>
            <h1>Título {{ task.title }}</h1>
            <div class="options d-flex gap-2">
              <router-link type="button" class="btn btn-info" :to="{ name: 'items', params: { id: task.id } }">Ver mais</router-link>
              <button type="button" class="btn btn-warning" @click="editTask(task)">Editar</button>
              <Button text="Excluir" class="btn btn-danger" :isLoading="taskListStore.isLoading.delete[task.id]" @click="deleteTask(task.id)"></Button>
            </div>
          </div>
        </div>
      </div>

      <!-- Paginação -->
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

    <!-- Modal de criação -->
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
  </div>
</template>

<script setup>
import Modal from "@/components/Modal.vue";
import Button from "@/components/Button.vue";
import { onMounted, ref } from "vue";
import { useUserStore } from "@stores/user";
import { useTaskListStore } from "@stores/taskList";

const userStore = useUserStore();
const taskListStore = useTaskListStore();

// Para edição inline
const editingTaskId = ref(null);
const editingTitle = ref("");

async function _loadUser() {
  await userStore.getUser();
  taskListStore.user_id = userStore.id;
}

function _closeModal(){
  const modalElement = document.getElementById('createList');
  const modal = bootstrap.Modal.getInstance(modalElement);
  modal.hide();
}

async function _register(){
  await taskListStore.register();
  if(!taskListStore.errors){
    _closeModal();
    taskListStore.user_id = userStore.id;
    await taskListStore.read();
  }
}

// Funções de edição inline
function editTask(task) {
  editingTaskId.value = task.id;
  editingTitle.value = task.title;
}

function cancelEdit() {
  editingTaskId.value = null;
  editingTitle.value = "";
}

async function saveEdit(id) {
  try {
    await taskListStore.update(id, editingTitle.value);
    editingTaskId.value = null;
    editingTitle.value = "";
    await taskListStore.read(); // atualiza a lista
  } catch (error) {
    console.log(error);
  }
}

// Função de exclusão
async function deleteTask(id) {
  try {
    await taskListStore.delete(id);
    await taskListStore.read();
  } catch (error) {
    console.log(error);
  }
}

onMounted(async () => {
  await _loadUser();
  await taskListStore.read();
});
</script>

<style scoped>

</style>
