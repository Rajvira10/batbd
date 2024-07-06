import { Link } from "@inertiajs/react";
import React from "react";

const AccountNotVerified = () => {
    return (
        <div style={{ minHeight: "80vh" }}>
            <div className="pt-5"></div>
            <div className="card" style={{ width: "70%", margin: "0px auto" }}>
                <div className="card-body">
                    <h2 className="text-center py-3" style={{ fontSize: 32 }}>
                        Your account is not approved yet by admin
                    </h2>
                    <p className="text-center py-3">
                        You will access your profile whenever the admin approved
                        your account. Please be <br /> patient. If you have any
                        query please{" "}
                        <Link href="/contact">
                            <u>Contact</u>
                        </Link>
                        .
                    </p>
                </div>
            </div>
        </div>
    );
};

export default AccountNotVerified;
