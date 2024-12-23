import LockerItem from '@/Components/LockerItem';
import NavLink from '@/Components/NavLink';
import PrimaryButton from '@/Components/PrimaryButton';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { TLockerItem } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Dashboard({ content }: { content: TLockerItem[] }) {
    const user = usePage().props.auth.user;
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Open Locker
                </h2>
            }
        >
            <Head title="Ausleihe" />

            <div className="py-0 sm:py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden sm:rounded-lg dark:bg-gray-800">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <div className="flex flex-col gap-4">
                                {content.length === 0 && <div className="w-100 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                    <div className="text-gray-900 dark:text-gray-100">
                                        <h5 className="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Keine Artikel ausgeliehen.</h5>
                                        <div className='flex justify-center pt-4'>
                                            <Link href="/stations">
                                                <PrimaryButton>
                                                    Zu den Schränken
                                                </PrimaryButton>
                                            </Link>
                                        </div>
                                    </div>
                                </div>}

                                {
                                    content.length > 0 && <div className="flex flex-col gap-4">
                                        <div className="flex gap-4">
                                            <h3 className="text-xl font-bold">Ausgeliehene Artikel</h3>
                                        </div>
                                    </div>
                                }

                                {content.map((item) => <div key={item.id} className="w-100 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                    <div className="text-gray-900 dark:text-gray-100">
                                        <Link href={`/lockers/${item.id}`}>
                                            <h5 className="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{item.name}</h5>
                                        </Link>
                                    </div>
                                </div >)}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
