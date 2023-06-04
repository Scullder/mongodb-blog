import { useState } from 'react'
import { useStateContext } from '../contexts/ContextProvider.jsx';
import axiosClient from '../axios-client.js'

export default function Signup() {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');

    const {setUser, setToken} = useStateContext();

    const submit = (e) => {
        e.preventDefault();

        const payload = {
            email: email,
            password: password,
        }

        axiosClient.post('/signup', payload)
            .then(({data}) => {
                setToken(data.token);
                setUser(data.user);
            })
            .catch(error =>{
                const response = error.response;
                if(response && response.status === 422) {
                    console.log(response.data.errors);
                }
            })
    }

    const input = 'w-full outline-none border-b-2 bg-inherit text-center p-2 border-gray-400 focus:border-white text-gray-400 focus:text-white';

    return (
        <div className="bg-tile/50 w-[25%] mx-auto mt-[150px]">
            <form onSubmit={submit}>
                <h1 className="text-2xl w-full bg-tile/60 p-6">Signup</h1>
                <div className="p-6">
                    <input className={`${input}`} value={email} onChange={(e) => setEmail(e.target.value)}/>
                    <label className="text-sm">email</label>

                    <input className={`${input}`} type="password" value={password} onChange={(e) => setPassword(e.target.value)}/>
                    <label className="text-sm">password</label>

                    <button className="block w-full h-12 mt-8 mb-4 bg-green">Signup</button>                  
                </div>
            </form>
        </div>
    )
}