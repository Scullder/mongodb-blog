import {Navigate, createBrowserRouter} from "react-router-dom"
import GuestLayout from "./components/GuestLayout";
import DefaultLayout from "./components/DefaultLayout";
import Login from "./views/Login";
import Signup from "./views/Signup";
import User from "./views/User";

const router = createBrowserRouter([
    /* {
        path: '/signin',
        element: <Signin />
    }, */
    {
        path: '/',
        element: <DefaultLayout />,
        children: [
            {
                path: '/',
                element: <Navigate to='/user'/>
            },
            {
                path: '/user',
                element: <User />
            }
        ]
    },
    {
        path: '/',
        element: <GuestLayout />,
        children: [
            {
                path: '/login',
                element: <Login />
            },
            {
                path: '/signup',
                element: <Signup />
            }
        ]
    }
])

export default router;