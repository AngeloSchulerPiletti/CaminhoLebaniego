import axios from "axios";

// export function deleteAuthorizationTokens(){
//     delete axios.defaults.headers.common["Authorization"];
// }

export function apiRequestProtocol(token = null, headers = null) {
    var api_instance = axios.create({
        // baseURL: "http://127.0.0.1:8000/api/",
        baseURL: "http://192.168.0.12:8000/api/",
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
    if (headers){
      Object.keys(headers).forEach(header => {
        api_instance.defaults.headers.common[header] = headers[header];
      });
    }
    return api_instance;
}