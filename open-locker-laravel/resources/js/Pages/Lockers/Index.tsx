import PrimaryButton from '@/Components/PrimaryButton';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Locker, Station } from '@/types';
import { Head, Link } from '@inertiajs/react';

export default function Lockers({ lockers, station }: { lockers: Locker[], station: Station }) {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Lockers {station?.name}
                </h2>
            }
        >
            <Head title="Lockers" />

            <div className="py-0 sm:py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden sm:rounded-lg dark:bg-gray-800">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <div className='flex flex-col gap-4'>
                                <div className='flex justify-end'>
                                    <Link
                                        href={route('lockers.create', station.id)}
                                    >
                                        <PrimaryButton className="flex gap-4">
                                            Neu
                                        </PrimaryButton>
                                    </Link>
                                </div>
                                <div className="grid grid-cols-1 lg:grid-cols-3 gap-4">
                                    {lockers.map((locker) => (
                                        <div key={locker.id} className="w-100 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                            <Link href={`/lockers/${locker.id}`}>
                                                <h5 className="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{locker.designation}</h5>
                                                <p>{locker.content.name}</p>
                                            </Link>
                                            {locker.content.image&&<div className="w-2/5">
                                                <img src={route('lockers.image', locker.id)}
                                                     alt={`${locker.designation} image`}
                                                     className="object-cover h-full w-full"/>
                                            </div>}
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
            </div>
        </AuthenticatedLayout>
    );
}
