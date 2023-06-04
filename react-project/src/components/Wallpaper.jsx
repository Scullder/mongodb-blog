export default function Wallpaper(props) {
    return (
        <div className={`w-full h-full fixed top-0 left-0 -z-10 bg-cover bg-no-repeat ${props.image}`}></div>
    )
}