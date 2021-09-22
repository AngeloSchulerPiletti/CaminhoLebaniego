import axios from "axios";

export const api = axios.create({
    baseURL: "http://127.0.0.1:8000/api/",
});

export function deleteAuthorizationTokens(){
    delete axios.defaults.headers.common["Authorization"];
}

export function setAuthorizationToken(token, axios){
    axios.interceptors.request.use(
        (config) => {
          config.headers.Authorization = `Bearer ${token}`;
          return config;
        },
        (error) => {
          return Promise.reject(error);
        }
    );

    return axios;
}