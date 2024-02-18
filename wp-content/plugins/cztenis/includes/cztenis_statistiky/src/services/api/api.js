import axios from "axios"

export const axiosInstance = axios.create({
    baseURL: appLocalizer.apiUrl,
    withCredentials: true
})
