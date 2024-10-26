import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Locker } from '@/types';
import { Head, Link } from '@inertiajs/react';

export default function Lockers({ lockers }: { lockers: Locker[] }) {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Lockers
                </h2>
            }
        >
            <Head title="Lockers" />

            <div className="py-0 sm:py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden sm:rounded-lg dark:bg-gray-800">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <div className='flex flex-col gap-4'>
                                {lockers.map((locker) => (
                                    <div key={locker.id} className="w-100 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                        <Link href={`/lockers/${locker.id}`}>
                                            <h5 className="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Locker {locker.content.name}</h5>
                                        </Link>
                                        {locker.content.user_id &&
                                            <p className="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                                Ausgeliehen
                                            </p>
                                        }
                                    </div>)
                                )}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
