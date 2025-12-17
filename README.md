# API de Gerenciamento de Tarefas

Esta é uma API RESTful desenvolvida em **Laravel**, que permite gerenciar usuários, listas de tarefas (`TaskList`) e itens de listas (`ListItem`). A autenticação é feita via **Sanctum** e os endpoints estão protegidos por tokens.

---
Atenção: Pasta build do vue_app existente, endereço: 'public/taskList'
---

## Tecnologias

- PHP 8.4
- Laravel
- Sanctum (autenticação via token)
- MySQL / SQLite (qualquer banco suportado pelo Laravel)
- VUE 3 
- VITE

---

## Estrutura da API

### Recursos

1. **Auth**
   - `login` - Autenticação de usuário
   - `register` - Registro de usuário
   - `logout` - Encerrar sessão/token

2. **TaskList**
   - `create` - Criar uma lista de tarefas
   - `read` - Listar todas as listas do usuário
   - `update` - Atualizar título da lista
   - `delete` - Deletar lista e seus itens

3. **ListItem**
   - `create` - Criar um item em uma lista
   - `read` - Listar itens de uma lista (com filtro opcional por status)
   - `update` - Atualizar título do item
   - `changeStatus` - Alternar status entre pendente e concluído
   - `delete` - Deletar item

---

## Endpoints

### Auth

| Método | Endpoint        | Descrição                  | Autenticação |
|--------|----------------|---------------------------|--------------|
| POST   | /login          | Login de usuário          | ❌ |
| POST   | /register       | Registro de usuário       | ❌ |
| POST   | /logout         | Logout de usuário         | ✅ |

### TaskList

| Método | Endpoint             | Descrição                        | Autenticação |
|--------|---------------------|---------------------------------|--------------|
| POST   | /task_list           | Criar nova lista                 | ✅ |
| GET    | /task_list           | Listar todas as listas do usuário | ✅ |
| PATCH  | /task_list/{id}      | Atualizar título da lista        | ✅ |
| DELETE | /task_list/{id}      | Deletar lista e seus itens       | ✅ |

### ListItem

| Método | Endpoint                  | Descrição                            | Autenticação |
|--------|---------------------------|-------------------------------------|--------------|
| POST   | /list_item                | Criar um item na lista              | ✅ |
| GET    | /list_item                | Listar itens de uma lista            | ✅ |
| PATCH  | /list_item/{id}           | Atualizar título de um item          | ✅ |
| PATCH  | /list_item/changeStatus/{id} | Alterar status do item             | ✅ |
| DELETE | /list_item/{id}           | Deletar item da lista               | ✅ |

---
