import React from "react";
import Navbar from "./Navbar";
import Footer from "./Footer";
import { FiLogOut } from "react-icons/fi";
import { Link } from "@inertiajs/react";

const Layout = ({ children }) => {
    return (
        <div>
            <Navbar />
            <div
                className="bg-main"
                style={{ backgroundColor: "#F5F5F5", minHeight: "100vh" }}
            >
                {children}
                <Footer />
            </div>
            <Link
                href="/logout"
                className="position-fixed"
                style={{
                    bottom: "50px",
                    right: "20px",
                    zIndex: "1000",
                }}
            >
                <button className="btn btn-danger">
                    <FiLogOut />
                </button>
            </Link>
        </div>
    );
};

export default Layout;
