export default function Login() {

    const input = 'w-full outline-none border-b-2 bg-inherit text-center p-2 border-gray-400 focus:border-white text-gray-400 focus:text-white'

    return (
        <div className="bg-tile/50 w-[25%] mx-auto mt-[150px]">
            <form>
                <h1 className="text-2xl w-full bg-tile/60 p-6">Login</h1>
                <div className="p-6">
                    <input className={`${input}`}/>
                    <label className="text-sm">email</label>

                    <input className={`${input}`} type="password"/>
                    <label className="text-sm">password</label>

                    <button className="block w-full h-12 mt-8 mb-4 bg-green">Login</button>                  

                    <div className="text-center"> 
                        <a href="" className="text-sm text-gray-400 hover:text-white">Forgot password?</a>
                    </div>
                </div>
            </form>
        </div>
    )
}