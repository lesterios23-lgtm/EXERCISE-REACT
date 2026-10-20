function Button({ label = 'Click me', onClick }) {
    const handleClick = (event) => {
        if (onClick) {
            onClick(event);
            return;
        }

        alert('Button clicked!');
    };

    return (
        <button type="button" onClick={handleClick}>{label}</button>
    );
}

export default Button;
