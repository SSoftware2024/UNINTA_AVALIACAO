import axios from 'axios';
const API_URL = 'http://localhost:8000/api/';
const instanceAxios = async (timeout = 30000) => {
    try {
        const token = localStorage.getItem('@token');

        const instance = axios.create({
            baseURL: API_URL,
            timeout: timeout, //tempo máximo em milissegundos que a solicitação pode levar antes de ser cancelada, pode ser null, ou nem definir deixar como default
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Authorization': `Bearer ${token}`
            }
        });

        return instance
    } catch (error) {
        toast.error("Erro na configuração com o servidor")
    }
}

export default instanceAxios;
