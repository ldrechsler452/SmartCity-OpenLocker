import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Station } from '@/types';
import { Head } from '@inertiajs/react';
import CreateLockerForm from './Partials/CreateLockerForm';

export default function CreateLocker({station}: {station: Station}) {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Gegenstand erstellen
                </h2>
            }
        >
            <Head title="Stations" />

            <div className="py-0 sm:py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <div className='flex flex-col gap-4'>
                                <CreateLockerForm station={station}/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}