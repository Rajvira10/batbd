import { Link, useForm } from "@inertiajs/react";
import React from "react";
import { FaEyeSlash } from "react-icons/fa";

const Login = () => {
    return (
        <body className="bg-main" style={{ backgroundColor: "#f5f5f5" }}>
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
                            <div className="card-body">
                                <h4>Email Confirmed</h4>
                                <p className="py-3">
                                    Thank you for joining Beyond BATBD.
                                </p>
                                <Link href="/">
                                    <button
                                        className="btn btn-primary px-4 py-2 mt-2"
                                        style={{
                                            borderRadius: "50px",
                                            border: "1px solid #11111126",
                                            backgroundColor: "#0e2b63",
                                        }}
                                    >
                                        Next Step
                                    </button>
                                </Link>
                            </div>
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
