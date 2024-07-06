import { usePage } from "@inertiajs/react";
import React, { useEffect } from "react";
import { toast } from "react-toastify";

const Login = ({ email, member_id }) => {
    const { props } = usePage();
    const { message } = props.flash;

    useEffect(() => {
        if (message?.type == "success") {
            toast.success(message.content);
        }
    }, [message]);
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
                            <div className="card-body">
                                <h4>Email Confirmation</h4>
                                <p className="mt-3">
                                    A verification mail sent to{" "}
                                    <span class="text-primary">{email} </span>
                                    to confirm the validity of your email
                                    address. Go to inbox and follow the link to
                                    continue next step.
                                </p>
                            </div>
                            <div className="card-footer mt-5">
                                <p>
                                    Didn't receive the email?{" "}
                                    <a href={`/email/resend/${member_id}`}>
                                        Send again
                                    </a>
                                </p>
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
