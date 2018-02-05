import axios from 'axios';
import Auth from '../store/authen';
export function post(url,payload){
    return axios({
        method:'POST',
        url:url,
        data:payload,
        headers:{
            'Authorization': `Bearer ${Auth.state.api_token}`
        }
    })
}

export function get(url,payload){
    return axios({
        method:'GET',
        url:url,
        data:payload
    })
}
export function del(url,payload){
    return axios({
        method:'DELETE',
        url:url,
        data:payload,
        headers:{
            'Authorization': `Bearer ${Auth.state.api_token}`
        }
    })
}