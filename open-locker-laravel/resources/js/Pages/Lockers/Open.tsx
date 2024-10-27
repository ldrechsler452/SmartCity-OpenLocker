import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Locker } from '@/types';
import {Head, Link} from '@inertiajs/react';

export default function OpenLocker({ locker }: { locker: Locker }) {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Open Locker
                </h2>
            }
        >
            <Head title="Open" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden sm:rounded-lg dark:bg-gray-800">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            Locker {locker.designation} is open.
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
