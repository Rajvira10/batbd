import React from "react";
import Navbar from "./Navbar";
import Footer from "./Footer";
import { FiLogOut } from "react-icons/fi";
import { Link, usePage } from "@inertiajs/react";
import { BiUser } from "react-icons/bi";

const Layout = ({ children }) => {
    const { auth } = usePage().props;
    console.log(auth);
    return (
        <div>
            <Navbar />
            <div className="bg-main" style={{ minHeight: "89vh" }}>
                {children}
                <Footer />
            </div>
            {auth.is_admin && (
                <a
                    href="/admin"
                    className="position-fixed"
                    style={{
                        bottom: "100px",
                        right: "20px",
                        zIndex: "1000",
                    }}
                >
                    <button className="btn btn-primary">
                        <BiUser />
                    </button>
                </a>
            )}
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
