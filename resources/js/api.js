export default {
    all(url, payload, store, callback) {
        return axios.get(url, {
            params: payload,
        })
        .then((response) => {
            // console.log(response);
            if (store != null && callback != null) {
                store.dispatch(callback, response.data)
            }
            return response;
        })
        .catch((error) => {
            return Promise.reject(error);
        });
    },
    show(url, payload, store, callback) {
        return axios.get(url, {
            params: payload
        })
        .then((response) => {
            // console.log(response);
            if (store != null && callback != null) {
                store.dispatch(callback, response.data)
            }
            return response;
        })
        .catch((error) => {
            return Promise.reject(error);
        });
    },
    save(url, payload, store, callback) {
        return axios.post(url, payload)
        .then((response) => {
            // console.log(response);
            if (store != null && callback != null) {
                store.dispatch(callback, response.data)
            }
            return response;
        })
        .catch((error) => {
            return Promise.reject(error);
        });
    },
    
    update(url, payload, store, callback) {
        return axios.put(url, payload)
        .then((response) => {
            // console.log(response);
            if (store != null && callback != null) {
                store.dispatch(callback, response.data)
            }
            return response;
        })
        .catch((error) => {
            return Promise.reject(error);
        });
    },
    delete(url, store, callback) {
        return axios.delete(url)
        .then((response) => {
            // console.log(response);
            if (store != null && callback != null) {
                store.dispatch(callback, response.data)
            }
            return response;
        })
        .catch((error) => {
            return Promise.reject(error);
        });
    },
}