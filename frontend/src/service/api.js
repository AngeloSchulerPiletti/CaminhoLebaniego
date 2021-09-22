import axios from "axios";

// export function deleteAuthorizationTokens(){
//     delete axios.defaults.headers.common["Authorization"];
// }

export function apiRequestProtocol(token = null) {
    var api_instance = axios.create({
        baseURL: "http://127.0.0.1:8000/api/",
    });

    if (token) {
        api_instance.interceptors.request.use(
            (config) => {
              config.headers.Authorization = `Bearer ${token}`;
              return config;
            },
            (error) => {
              return Promise.reject(error);
            }
        );
    } 
    return api_instance;
}