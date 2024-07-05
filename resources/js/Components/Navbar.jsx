import { Link } from "@inertiajs/react";
import React from "react";

const Navbar = () => {
    const currentUrl = window.location.href;
    return (
        <header>
            <nav
                className="navbar navbar-expand-lg"
                style={{
                    backgroundColor: "#F5F5F5",
                    borderBottom: "2px solid white",
                }}
            >
                <div className="container-fluid">
                    <div className="d-flex align-items-center">
                        <Link className="navbar-brand" href="/">
                            <img
                                className="logo-lg"
                                src="/assets/images/logo-lg.png"
                                alt=""
                                srcSet=""
                                height={50}
                                width={161}
                            />
                        </Link>
                        <p className="ps-2">
                            Reconnect and Collaborate with <br /> Your
                            Ex-Colleagues at BAT BD
                        </p>
                    </div>
                    <button
                        className="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarNav"
                        aria-controls="navbarNav"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span className="navbar-toggler-icon"></span>
                    </button>
                    <div className="collapse navbar-collapse" id="navbarNav">
                        <ul className="navbar-nav ms-auto">
                            <li className="nav-item">
                                <Link
                                    className={`nav-link ${
                                        currentUrl === "/" ? "active" : ""
                                    }`}
                                    aria-current="page"
                                    href="/"
                                >
                                    My Profile
                                </Link>
                            </li>
                            <li className="nav-item">
                                <Link
                                    className={`nav-link ${
                                        currentUrl.includes("/members")
                                            ? "active"
                                            : ""
                                    }`}
                                    href="/members"
                                >
                                    Members
                                </Link>
                            </li>
                            <li className="nav-item">
                                <Link
                                    className={`nav-link ${
                                        currentUrl.includes("/news")
                                            ? "active"
                                            : ""
                                    }`}
                                    href="/news"
                                >
                                    News
                                </Link>
                            </li>
                            <li className="nav-item">
                                <Link
                                    className={`nav-link ${
                                        currentUrl.includes("/gallery")
                                            ? "active"
                                            : ""
                                    }`}
                                    href="/gallery"
                                >
                                    Gallery
                                </Link>
                            </li>
                            <li className="nav-item">
                                <Link
                                    className={`nav-link ${
                                        currentUrl.includes("/disclosures")
                                            ? "active"
                                            : ""
                                    }`}
                                    href="/disclosures"
                                >
                                    Disclosures
                                </Link>
                            </li>

                            <li className="nav-item">
                                <Link
                                    className={`nav-link ${
                                        currentUrl.includes("/contact")
                                            ? "active"
                                            : ""
                                    }`}
                                    href="/contact"
                                >
                                    Contact
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    );
};

export default Navbar;
