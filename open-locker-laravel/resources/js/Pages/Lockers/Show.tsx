import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Locker } from '@/types';
import {Head, Link} from '@inertiajs/react';

export default function ShowLocker({ locker }: { locker: Locker }) {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Lockers
                </h2>
            }
        >
            <Head title="Lockers" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <div className='flex flex-col gap-4'>
                                    <div className="w-100 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                        <Link href={`/lockers/${locker.id}/open`}>
                                            <h5 className="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Locker {locker.designation}</h5>
                                        </Link>
                                        <p className="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                            Last opened at: {new Date(locker.last_opened_at).toLocaleString()}
                                        </p>
                                        <p className="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                            Is open: {locker.is_open ? 'Yes' : 'No'}
                                        </p>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
