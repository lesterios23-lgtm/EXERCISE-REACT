import { useState } from "react";

function Form() {
    const [name, setName] = useState("");

    //events
    const handleSubmit = (e) => {
        e.preventDefault();
        console.log("Submitted name: ", name);
    }
    return (
        <>
            <form method="post" onSubmit={handleSubmit}>
                <input
                    type="text"
                    value={name}
                    onChange={(e) => setName(e.target.value)} //It upadates state on every stoke
                    placeholder="Enter your name"
                />
                <button type="submit">Submit</button>
            </form>
        </>
    );
}

export default Form;