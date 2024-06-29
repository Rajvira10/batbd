import { Link, useForm } from "@inertiajs/react";
import React from "react";
import { FaEyeSlash } from "react-icons/fa";

const Login = () => {
    const { data, setData, post, processing, errors } = useForm({
        email: "",
        password: "",
    });

    const handleChange = (e) => {
        const key = e.target.id;
        const value = e.target.value;
        setData((data) => ({
            ...data,
            [key]: value,
        }));
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        post("/authenticate");
    };

    return (
        <body className="bg-main">
            <div className="container">
                <div className="row frm-pg">
                    <div className="col-xl-6 d-flex justify-content-center justify-content-xl-start text-center text-xl-start">
                        <div className="cmp-logo">
                            <img
                                className="logo-lg"
                                src="/assets/images/logo-lg.png"
                                alt=""
                                srcSet=""
                            />
                            <p className="cmp-text">
                                Reconnect and Collaborate with{" "}
                                <br className="d-none d-xl-block" /> Your
                                Ex-Colleagues at BAT BD
                            </p>
                        </div>
                    </div>
                    <div className="col-xl-6 d-flex justify-content-center justify-content-xl-end mt-5 mt-xl-0">
                        <div className="frm-wrap w-100">
                            <form onSubmit={handleSubmit}>
                                <h3 className="fm-title text-center text-xl-start">
                                    Login
                                </h3>

                                <div className="mb-2">
                                    <input
                                        type="email"
                                        className="form-control"
                                        id="email"
                                        placeholder="Email"
                                        value={data.email}
                                        onChange={handleChange}
                                    />
                                    {errors.email && (
                                        <div
                                            className="text-danger"
                                            style={{ fontSize: "12px" }}
                                        >
                                            {errors.email}
                                        </div>
                                    )}
                                </div>
                                <div className="input-icon-end mb-2">
                                    <input
                                        type="password"
                                        className="form-control"
                                        id="password"
                                        placeholder="Set a Password"
                                        value={data.password}
                                        onChange={handleChange}
                                    />
                                    <FaEyeSlash
                                        style={{
                                            position: "absolute",
                                            top: "50%",
                                            right: "30px",
                                            transform: errors.password
                                                ? "translateY(-100%)"
                                                : "translateY(-50%)",
                                        }}
                                        onClick={() => {
                                            const input =
                                                document.querySelector(
                                                    "#password"
                                                );
                                            input.type =
                                                input.type === "password"
                                                    ? "text"
                                                    : "password";
                                        }}
                                    />
                                    {errors.password && (
                                        <div
                                            className="text-danger"
                                            style={{ fontSize: "12px" }}
                                        >
                                            {errors.password}
                                        </div>
                                    )}
                                </div>

                                <div className="row mt-4 mb-5 align-items-center">
                                    <div className="col-sm-6">
                                        <button
                                            type="submit"
                                            className="btn btn-round btn-gray bg-gray text-light px-5 py-2 fs-20"
                                        >
                                            Login
                                        </button>
                                    </div>
                                    <div className="col-sm-6 text-center text-sm-end mt-3 mt-sm-0">
                                        <Link
                                            href="/forgot-password"
                                            className="text-dark fw-semibold"
                                        >
                                            Forgot your password?
                                        </Link>
                                    </div>
                                </div>

                                <div className="text-center">
                                    <p className="scl-text fs-20 text-center px-3">
                                        Or log in with
                                    </p>
                                    <div className="scl-dvdr"></div>
                                </div>

                                <div className="row mt-5 justify-content-center scl-btn">
                                    <div className="text-center col-md-6 mb-3 mb-md-0">
                                        <a
                                            href="#"
                                            className="btn btn-round outline-dark py-1 fs-20"
                                        >
                                            <img
                                                className="me-2"
                                                src="./assets/images/icons/fb-logo.png"
                                                alt=""
                                                srcSet=""
                                            />
                                            Facebook
                                        </a>
                                    </div>
                                    <div className="text-center col-md-6">
                                        <a
                                            href="#"
                                            className="btn btn-round outline-dark py-1 fs-20"
                                        >
                                            <img
                                                className="me-2"
                                                src="./assets/images/icons/google.png"
                                                alt=""
                                                srcSet=""
                                            />
                                            Google
                                        </a>
                                    </div>
                                </div>

                                <p className="mt-5 text-center text-xl-start">
                                    Not a member?{" "}
                                    <Link
                                        href="/register"
                                        className="text-dark fw-semibold"
                                    >
                                        Join today
                                    </Link>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <footer>
                <div className="container">
                    <div className="row">
                        <div className="col-lg-4 mb-4 mb-lg-0">
                            <p className="footer-text fw-semibold">
                                © 2024 - <br /> Beyond BATBD. All rights
                                reserved
                            </p>
                        </div>
                        <div className="col-lg-4 mb-4 mb-lg-0">
                            <p className="footer-text">
                                <span className="text-muted">Designed by</span>{" "}
                                <i>Intelligent Machines</i> <br />{" "}
                                <span className="text-muted">Built by</span>{" "}
                                <i>Webbly Solutions</i>
                            </p>
                        </div>
                        <div className="col-lg-4 mb-4">
                            <p className="footer-text">
                                <span className="fw-semibold">
                                    Special thanks to
                                </span>{" "}
                                <br /> Shafayet Kamal Shiddiki
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </body>
    );
};

export default Login;
