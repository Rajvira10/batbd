import React from "react";
import { ToastContainer } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";

const AppWrapper = ({ children }) => {
    return (
        <>
            {children}
            <ToastContainer />
        </>
    );
};

export default AppWrapper;
